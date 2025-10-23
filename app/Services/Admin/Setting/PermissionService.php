<?php

namespace App\Services\Admin\Setting;

use Spatie\Permission\Models\Permission;

class PermissionService extends SettingService
{
    protected $model = Permission::class;

    public function get_permission_groups()
    {
        return $this->model::select('group_name')->groupBy('group_name')->get();
    }

    public function filter(array $data)
    {
        $limit = $data['limit'] ?? 25;
        $query = $this->model::query();
        if (isset($data['search']) && !empty($data['search'])) {
            $search = $data['search'];
            $query->where('name', 'like', "%$search%");
        }

        if (isset($data['group_name']) && !empty($data['group_name'])) {
            $query->where('group_name', $data['group_name']);
        }

        $permissions = $query
            ->orderBy('sort', 'asc')
            ->paginate($limit);
        return $permissions;
    }
}
