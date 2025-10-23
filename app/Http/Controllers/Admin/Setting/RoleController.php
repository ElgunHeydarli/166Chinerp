<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\RolePermissionRequest;
use App\Http\Requests\Admin\Setting\RoleRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\PermissionService;
use App\Services\Admin\Setting\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use Sortable;

    public function __construct(
        public RoleService $roleService,
        public PermissionService $permissionService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleService->getAll();
        return view('back.pages.setting.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $this->roleService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.role.index');
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
        $role = $this->roleService->getById($id);
        return view('back.pages.setting.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $data = $request->validated();
        $this->roleService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->roleService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.role.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->roleService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->roleService, $request->get('sorted_ids', []));
        return response($response);
    }

    public function assign_permission(int $id)
    {
        $role = $this->roleService->getById($id);
        $permission_groups = $this->permissionService->get_permission_groups();
        return view('back.pages.setting.role.assign-permission', compact('role', 'permission_groups'));
    }

    public function assign_permission_post(int $id, RolePermissionRequest $request)
    {
        $role = $this->roleService->getById($id);
        $data = $request->validated();
        $this->roleService->assign_permissions($role, $data['permission_id'] ?? []);
        toastr('Seçilmiş icazələr mənimsədildi');
        return redirect()->route('admin.role.index');
    }
}
