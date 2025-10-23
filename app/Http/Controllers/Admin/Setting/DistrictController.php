<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\DistrictRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\CityService;
use App\Services\Admin\Setting\DistrictService;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    use Sortable;

    public function __construct(
        public DistrictService $districtService,
        public CityService $cityService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = $this->districtService->getAll();
        return view('back.pages.setting.district.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = $this->cityService->getAll();
        return view('back.pages.setting.district.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DistrictRequest $request)
    {
        $data = $request->validated();
        $this->districtService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.district.index');
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
        $district = $this->districtService->getById($id);
        $cities = $this->cityService->getAll();
        return view('back.pages.setting.district.edit', compact('district', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DistrictRequest $request, string $id)
    {
        $data = $request->validated();
        $this->districtService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.district.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->districtService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.district.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->districtService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->districtService, $request->get('sorted_ids', []));
        return response($response);
    }
}
