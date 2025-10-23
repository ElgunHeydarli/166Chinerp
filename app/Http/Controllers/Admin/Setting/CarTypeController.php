<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\CarTypeRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\CarTypeService;
use Illuminate\Http\Request;

class CarTypeController extends Controller
{
    use Sortable;

    public function __construct(public CarTypeService $carTypeService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $car_types = $this->carTypeService->getAll();
        return view('back.pages.setting.car-type.index', compact('car_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.car-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarTypeRequest $request)
    {
        $data = $request->validated();
        $this->carTypeService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.car-type.index');
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
        $car_type = $this->carTypeService->getById($id);
        return view('back.pages.setting.car-type.edit', compact('car_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarTypeRequest $request, string $id)
    {
        $data = $request->validated();
        $this->carTypeService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.car-type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->carTypeService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.car-type.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->carTypeService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->carTypeService, $request->get('sorted_ids', []));
        return response($response);
    }
}
