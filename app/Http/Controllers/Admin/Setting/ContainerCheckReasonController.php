<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\ContainerCheckReasonRequest;
use App\Services\Admin\Setting\ContainerCheckReasonService;
use Illuminate\Http\Request;

class ContainerCheckReasonController extends Controller
{
    public function __construct(public ContainerCheckReasonService $containerCheckReasonService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $container_check_reasons = $this->containerCheckReasonService->getAll();
        return view('back.pages.setting.container-check-reason.index', compact('container_check_reasons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.container-check-reason.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContainerCheckReasonRequest $request)
    {
        $data = $request->validated();
        $this->containerCheckReasonService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.container-check-reason.index');
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
        $container_check_reason = $this->containerCheckReasonService->getById($id);
        return view('back.pages.setting.container-check-reason.edit', compact('container_check_reason'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContainerCheckReasonRequest $request, string $id)
    {
        $data = $request->validated();
        $this->containerCheckReasonService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.container-check-reason.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->containerCheckReasonService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.container-check-reason.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->containerCheckReasonService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }
}
