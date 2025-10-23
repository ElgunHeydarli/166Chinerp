<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ContainerStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookingDateContainerRequest;
use App\Http\Requests\Admin\BookingDateRequest;
use App\Http\Requests\Admin\BookingDateStatusRequest;
use App\Services\Admin\BookingDateContainerService;
use App\Services\Admin\BookingDateService;
use App\Services\Admin\ContainerPriceService;
use App\Services\Admin\ContainerService;
use App\Services\Admin\Setting\ContainerCheckReasonService;
use App\Services\Admin\Setting\ContainerTypeService;
use App\Services\Admin\Setting\StationService;
use App\Services\Admin\Setting\StatusService;
use App\Services\Admin\VendorService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingDateController extends Controller
{
    public function __construct(
        public BookingDateContainerService $bookingDateContainerService,
        public ContainerCheckReasonService $containerCheckReasonService,
        public ContainerPriceService $containerPriceService,
        public ContainerTypeService $containerTypeService,
        public BookingDateService $bookingDateService,
        public ContainerService $containerService,
        public StationService $stationService,
        public StatusService $statuseService,
        public VendorService $vendorService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('Rezervasiya tarixləri page');
        $booking_dates = $this->bookingDateService->getAll();
        $booking_date_containers = $this->bookingDateContainerService->getAll();
        $containers = $this->containerService->getContainersByStatus(ContainerStatus::ACCEPTED);
        $statuses = $this->statuseService->getAll();
        return view('back.pages.booking-date.index', compact('booking_dates', 'booking_date_containers', 'containers', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('Rezervasiya tarixləri page-Əlavə et');
        $container_types = $this->containerTypeService->getAll();
        $stations = $this->stationService->getAll();
        $vendors = $this->vendorService->getAll();
        return view('back.pages.booking-date.create', compact('vendors', 'container_types', 'stations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingDateRequest $request)
    {
        $this->authorize('Rezervasiya tarixləri page-Əlavə et');
        $data = $request->validated();
        $data['price'] = $this->containerPriceService->get_price($data['container_type_id'], $data['station_id']);
        $container_type = $this->containerTypeService->getById($data['container_type_id']);
        $data['total_price'] = $data['price'] * $data['count'];
        $data['total_cbm'] = $data['count'] * $container_type->max_size;
        $data['remainder'] = $data['total_price'];
        $data['remainder_cbm'] = $data['total_cbm'];
        $data['remainder_count'] = $data['count'];
        $this->bookingDateService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.booking-date.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking_date = $this->bookingDateService->getByIdWithContainers($id);
        return response([
            'id' => $booking_date->id,
            'date' => $booking_date->date?->format('d.m.Y') ?? 'Yoxdur',
            'total_cbm' => $booking_date->total_cbm,
            'remainder_cbm' => $booking_date->remainder_cbm,
            'container_count' => $booking_date->count,
            'remainder_count' => $booking_date->remainder_count,
            'containers' => $booking_date->containers,
        ]);
    }

    public function detail(int $id)
    {
        $this->authorize('Rezervasiya tarixləri page - Əməliyyatlar - Bax');
        $booking_date = $this->bookingDateService->getByIdWithContainers($id);
        $booking_dates = $this->bookingDateService->get_booking_dates();
        $containers = $this->bookingDateService->get_containers($booking_date);
        $container_check_reasons = $this->containerCheckReasonService->getActive();
        return view('back.pages.booking-date.detail', compact('booking_date', 'booking_dates', 'containers', 'container_check_reasons'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('Rezervasiya tarixləri page - Əməliyyatlar - Düzəlt');
        $booking_date = $this->bookingDateService->getById($id);
        $container_types = $this->containerTypeService->getAll();
        $stations = $this->stationService->getAll();
        $vendors = $this->vendorService->getAll();
        return view('back.pages.booking-date.edit', compact('booking_date', 'container_types', 'stations', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingDateRequest $request, string $id)
    {
        $this->authorize('Rezervasiya tarixləri page - Əməliyyatlar - Düzəlt');
        $data = $request->validated();
        $data['price'] = $this->containerPriceService->get_price($data['container_type_id'], $data['station_id']);
        $data['total_price'] = $data['price'] * $data['count'];
        $this->bookingDateService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.booking-date.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('Rezervasiya tarixləri page - Əməliyyatlar - Sil');
        $this->bookingDateService->delete($id);
        return response([
            'status' => 'success',
            'message' => 'Məlumat uğurla silindi',
        ]);
    }

    public function change_status(int $id, BookingDateStatusRequest $request)
    {
        $this->authorize('Rezervasiya tarixləri page - Əməliyyatlar - Statusu dəyiş');
        $statuses = $this->statuseService->getAll();
        $status_id = $request->get('status_id');
        $booking_date = $this->bookingDateService->getById($id);
        $response = $this->bookingDateService->add_status($booking_date, $statuses, $status_id);
        return $response;
    }

    public function get_container_price(Request $request)
    {
        try {
            $price = $this->containerPriceService->get_price($request->get('container_type_id'), $request->get('station_id'));
            return response([
                'status' => 'success',
                'data' => $price,
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function get_status_info(int $id)
    {
        $booking_date = $this->bookingDateService->getByIdWithStatuses($id);
        if (is_null($booking_date))
            return response([
                'status' => 'error',
                'message' => 'Məlumat tapılmadı',
            ]);
        $statuses = $this->statuseService->getAll();
        $status_info = $this->bookingDateService->get_status_info($booking_date, $statuses);
        return response([
            'status' => 'success',
            'data' => [
                'date' => $booking_date->date->format('d.m.Y'),
                'current_status' => $booking_date->statuses()->orderByDesc('id')->first()?->id,
                'statuses' => $status_info,
            ],
        ]);
    }

    public function add_check(int $id, Request $request)
    {
        $this->authorize('Rezervasiya tarixləri page - Əməliyyatlar - Bax - Yoxlamaya at');
        try {
            $booking_date = $this->bookingDateService->getById($id);
            $data = $request->validate([
                'container_ids' => ['required', 'array'],
                'container_ids.*' => ['required', 'integer', 'exists:containers,id'],
                'note' => ['nullable', 'string'],
                'container_check_reason_id' => ['nullable', 'integer', 'exists:container_check_reasons,id'],
            ]);

            $this->bookingDateService->add_check($booking_date, $data);
            toastr('Seçilmiş konteynerlər yoxlamaya göndərildi');
            return redirect()->back();
        } catch (\Exception $ex) {
            toastr($ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function update_checking_containers(BookingDateContainerRequest $request)
    {
        $this->authorize('Rezervasiya tarixləri page - Əməliyyatlar - Bax - Rez.tarixini dəyiş');
        $container_ids = explode(',', $request->get('container_ids', [])[0]);
        $date = Carbon::createFromFormat('d.m.Y', $request->get('booking_date'))->format('Y-m-d');
        $booking_date = $this->bookingDateService->getByDate($date);
        if (is_null($booking_date)) {
            $booking_date = $this->bookingDateService->create([
                'date' => $date,
                'price' => 0,
                'total_price' => 0,
                'station_id' => 1,
                'container_type_id' => $this->containerService->getById($container_ids[0])->container_type_id,
                'total_cbm' => $this->containerService->getById($container_ids[0])->volume * count($container_ids),
                'remainder_cbm' => $this->containerService->getById($container_ids[0])->volume * count($container_ids),
                'vendor_id' => 1,
                'count' => count($container_ids),
                'status' => 1,
            ]);
        }

        $booking_date_containers = $this->bookingDateContainerService->getByContainerIds($container_ids);
        foreach ($booking_date_containers as $booking_date_container) {
            $booking_date_container->delete();
        }

        foreach ($container_ids as $container_id) {
            $booking_date_container = $this->bookingDateService->get_booking_container($booking_date, $container_id);
            $this->bookingDateContainerService->create(['booking_date_id' => $booking_date->id, 'container_id' => $container_id, 'status' => 1]);
        }

        toastr('Seçilmiş konteynerlərin rezervasiya tarixi dəyişdirilmişdir');
        return redirect()->route('admin.booking-date.index', ['type' => 'booking_date']);
    }

    public function update_booking_date(BookingDateContainerRequest $request)
    {
        $this->authorize('Yoxlamada olan konteynerlər page-Seç-Rez. tarixi təyin et');
        try {
            $container_ids = $request->get('container_ids', []);
            $date = Carbon::createFromFormat('d.m.Y', $request->get('booking_date'))->format('Y-m-d');
            $booking_date = $this->bookingDateService->getByDate($date);
            if (is_null($booking_date)) {
                toastr('Seçilən tarixə görə rezervasiya tapılmadı', 'error');
                return redirect()->back();
            }

            foreach ($container_ids as $container_id) {
                $this->bookingDateService->delete_containers($booking_date, $container_id);
                $booking_date->containers()->create([
                    'container_id' => $container_id,
                ]);
            }

            toastr('Seçilmiş konteynerlərin rezervasiya tarixi dəyişdirilmişdir');
            return redirect()->route('admin.booking-date.index');
        } catch (\Exception $ex) {
            toastr($ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function import(Request $request)
    {
        $request->validate(['file'=>['required','file','mimes:xlsx']]);
        return $this->bookingDateService->import_bookings($request);
    }
}
