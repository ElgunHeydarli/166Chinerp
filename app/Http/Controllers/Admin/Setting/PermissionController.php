<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\PermissionRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use Sortable;

    public function __construct(public PermissionService $permissionService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $permissions = $this->permissionService->filter($data);
        $group_names = $this->permissionService->get_permission_groups();
        return view('back.pages.setting.permission.index', compact('permissions','group_names'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $data = $request->validated();
        $this->permissionService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.permission.index');
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
        $permission = $this->permissionService->getById($id);
        return view('back.pages.setting.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, string $id)
    {
        $data = $request->validated();
        $this->permissionService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->permissionService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.permission.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->permissionService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->permissionService, $request->get('sorted_ids', []));
        return response($response);
    }
}
