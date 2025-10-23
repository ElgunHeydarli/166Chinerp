<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\WarehouseRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    use Sortable;

    public function __construct(public WarehouseService $warehouseService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = $this->warehouseService->getAll();
        return view('back.pages.setting.warehouse.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseRequest $request)
    {
        $data = $request->validated();
        $this->warehouseService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.warehouse.index');
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
        $warehouse = $this->warehouseService->getById($id);
        return view('back.pages.setting.warehouse.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WarehouseRequest $request, string $id)
    {
        $data = $request->validated();
        $this->warehouseService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.warehouse.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->warehouseService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.warehouse.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->warehouseService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->warehouseService, $request->get('sorted_ids', []));
        return response($response);
    }
}
