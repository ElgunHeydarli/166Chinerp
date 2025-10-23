<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SectorRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\SectorService;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    use Sortable;

    public function __construct(public SectorService $sectorService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectors = $this->sectorService->getAll();
        return view('back.pages.setting.sector.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.sector.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectorRequest $request)
    {
        $data = $request->validated();
        $this->sectorService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.sector.index');
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
        $sector = $this->sectorService->getById($id);
        return view('back.pages.setting.sector.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectorRequest $request, string $id)
    {
        $data = $request->validated();
        $this->sectorService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.sector.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->sectorService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.sector.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->sectorService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->sectorService, $request->get('sorted_ids', []));
        return response($response);
    }
}
