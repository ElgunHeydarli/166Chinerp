<?php

namespace App\Services\Admin\Setting;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleService extends SettingService
{
    protected $model = Role::class;

    public function assign_permissions(Role $role, array $permission_ids)
    {
        $permissions = Permission::find($permission_ids);
        $role->givePermissionTo($permissions);
    }
}
