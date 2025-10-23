<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\MixFullRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\MixFullService;
use Illuminate\Http\Request;

class MixFullController extends Controller
{
    use Sortable;

    public function __construct(public MixFullService $containerTypeService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mix_fulles = $this->containerTypeService->getAll();
        return view('back.pages.setting.mix-full.index', compact('mix_fulles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.mix-full.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MixFullRequest $request)
    {
        $data = $request->validated();
        $data['short_name'] = str()->lower($data['name']);
        $this->containerTypeService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.mix-full.index');
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
        $mix_full = $this->containerTypeService->getById($id);
        return view('back.pages.setting.mix-full.edit', compact('mix_full'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MixFullRequest $request, string $id)
    {
        $data = $request->validated();
        $this->containerTypeService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.mix-full.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->containerTypeService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.mix-full.index');
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
}
