<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\TransportationServiceRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\TransportationService;
use App\Services\Admin\Setting\TransportationServiceService;
use App\Services\Admin\Setting\TransportationTypeService;
use Illuminate\Http\Request;

class TransportationServiceController extends Controller
{
    use Sortable;

    public function __construct(
        public TransportationServiceService $transportationServiceService,
        public TransportationTypeService $transportationTypeService,
        public TransportationService $transportationService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transportation_services = $this->transportationServiceService->getAll();
        return view('back.pages.setting.transportation-service.index', compact('transportation_services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transportation_types = $this->transportationTypeService->getAll();
        return view('back.pages.setting.transportation-service.create', compact('transportation_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransportationServiceRequest $request)
    {
        $data = $request->validated();
        $this->transportationServiceService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.transportation-service.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transportation_service = $this->transportationServiceService->getById($id);
        $transportation_types = $this->transportationTypeService->getAll();
        return view('back.pages.setting.transportation-service.edit', compact('transportation_service', 'transportation_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransportationServiceRequest $request, string $id)
    {
        $data = $request->validated();
        $this->transportationServiceService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.transportation-service.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->transportationServiceService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.transportation-service.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->transportationServiceService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->transportationServiceService, $request->get('sorted_ids', []));
        return response($response);
    }

    public function get_transportations(int $id)
    {
        $transportations = $this->transportationService->get_transportations($id);
        if (count($transportations) == 0) {
            return response([
                'status' => 'error',
                'message' => 'Məlumat tapılmadı',
            ]);
        }

        return response([
            'status' => 'success',
            'data' => $transportations
        ]);
    }
}
