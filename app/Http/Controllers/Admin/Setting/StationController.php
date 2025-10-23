<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\StationRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\StationService;
use Illuminate\Http\Request;

class StationController extends Controller
{
    use Sortable;

    public function __construct(public StationService $stationService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stations = $this->stationService->getAll();
        return view('back.pages.setting.station.index', compact('stations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.station.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StationRequest $request)
    {
        $data = $request->validated();
        $this->stationService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.station.index');
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
        $station = $this->stationService->getById($id);
        return view('back.pages.setting.station.edit', compact('station'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StationRequest $request, string $id)
    {
        $data = $request->validated();
        $this->stationService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.station.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->stationService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.station.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->stationService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->stationService, $request->get('sorted_ids', []));
        return response($response);
    }
}
