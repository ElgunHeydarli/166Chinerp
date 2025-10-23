<?php

namespace App\Services\Admin\Setting;

use App\Models\District;

class DistrictService extends SettingService
{
    protected $model = District::class;

    public function getAll()
    {
        return $this->model::orderBy('name', 'asc')->get();
    }

    public function getActive()
    {
        return $this->model::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();
    }
}
