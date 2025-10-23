<?php

namespace App\Services\Admin\Setting;

use App\Services\MainService;

class SettingService extends MainService
{
    protected $model;

    public function getAll()
    {
        return $this->model::orderBy('sort', 'asc')->get();
    }

    public function getActive()
    {
        return $this->model::where('status', 1)->orderBy('sort', 'asc')->get();
    }
}
