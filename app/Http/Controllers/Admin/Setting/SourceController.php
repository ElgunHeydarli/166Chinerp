<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SourceRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\SourceService;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    use Sortable;

    public function __construct(public SourceService $sourceService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sources = $this->sourceService->getAll();
        return view('back.pages.setting.source.index', compact('sources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.source.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SourceRequest $request)
    {
        $data = $request->validated();
        $this->sourceService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.source.index');
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
        $source = $this->sourceService->getById($id);
        return view('back.pages.setting.source.edit', compact('source'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SourceRequest $request, string $id)
    {
        $data = $request->validated();
        $this->sourceService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.source.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->sourceService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.source.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->sourceService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->sourceService, $request->get('sorted_ids', []));
        return response($response);
    }
}
