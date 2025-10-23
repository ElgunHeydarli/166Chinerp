<?php

namespace App\Services\Admin\Setting;

use App\Models\AboutBookingDate;
use App\Services\MainService;

class AboutBookingDateService extends SettingService
{
    protected $model = AboutBookingDate::class;

    public function getAll()
    {
        return $this->model::orderBy('date', 'desc')->get();
    }

    public function getActive()
    {
        return $this->model::where('status', 1)
            ->orderBy('date', 'desc')
            ->get();
    }

    public function getByDate($date)
    {
        return $this->model::where('date', $date)->first();
    }
}
