<?php

namespace App\Services\Admin\Setting;

use App\Models\Status;

class StatusService extends SettingService
{
    protected $model = Status::class;

    public function getLatestStatus()
    {
        return $this->model::orderBy('sort', 'desc')->first();
    }
}
