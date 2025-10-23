<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\CityRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use Sortable;

    public function __construct(public CityService $cityService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = $this->cityService->getAll();
        return view('back.pages.setting.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $data = $request->validated();
        $this->cityService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.city.index');
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
        $city = $this->cityService->getById($id);
        return view('back.pages.setting.city.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, string $id)
    {
        $data = $request->validated();
        $this->cityService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.city.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->cityService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.city.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->cityService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->cityService, $request->get('sorted_ids', []));
        return response($response);
    }
}
