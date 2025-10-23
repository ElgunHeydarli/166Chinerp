<?php

namespace App\Services\Admin\Setting;

use App\Models\ContainerType;

class ContainerTypeService extends SettingService
{
    protected $model = ContainerType::class;

    public function getByName(string $name)
    {
        return $this->model::where('name', $name)->first();
    }
}
