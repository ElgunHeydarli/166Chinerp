<?php

namespace App\Services\Admin\Setting;

use App\Models\City;

class CityService extends SettingService
{
    protected $model = City::class;

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
