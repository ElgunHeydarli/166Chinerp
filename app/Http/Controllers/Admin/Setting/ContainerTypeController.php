<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Enums\ContainerStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\ContainerTypeRequest;
use App\Http\Traits\Sortable;
use App\Models\BookingDate;
use App\Models\BookingDateContainer;
use App\Services\Admin\Setting\ContainerTypeService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContainerTypeController extends Controller
{
    use Sortable;

    public function __construct(public ContainerTypeService $containerTypeService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $container_types = $this->containerTypeService->getAll();
        return view('back.pages.setting.container-type.index', compact('container_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.container-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContainerTypeRequest $request)
    {
        $data = $request->validated();
        $this->containerTypeService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.container-type.index');
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
        $container_type = $this->containerTypeService->getById($id);
        return view('back.pages.setting.container-type.edit', compact('container_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContainerTypeRequest $request, string $id)
    {
        $data = $request->validated();
        $this->containerTypeService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.container-type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->containerTypeService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.container-type.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->containerTypeService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->containerTypeService, $request->get('sorted_ids', []));
        return response($response);
    }

    public function get_containers(int $id, Request $request)
    {
        $date = $request->get('booking_date');
        $container_type = $this->containerTypeService->getById($id);

        $booking_date = null;
        if (!is_null($date)) {
            $booking_date = BookingDate::where('date', Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d'))->first();
        }

        $containers = $container_type->containers()
            ->whereNotNull('code') // ← Code null olmasın
            ->where(function ($q) use ($booking_date) {
                // Əgər tarix varsa, uyğun tarixli və ya boş konteynerlər
                if ($booking_date) {
                    $q->whereDoesntHave('booking_containers')
                        ->orWhereHas('booking_containers', function ($q) use ($booking_date) {
                            $q->where('booking_date_id', $booking_date->id);
                        });
                } else {
                    // Tarix yoxdursa, yalnız boş konteynerlər
                    $q->whereDoesntHave('booking_containers');
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response([
            'status' => 'success',
            'data' => $containers,
        ]);
    }


}
