<?php

namespace App\Services\Admin\Setting;

use App\Models\Transportation;

class TransportationService extends SettingService
{
    protected $model = Transportation::class;

    public function get_transportations(int $transportation_id)
    {
        return $this->model::where('transportation_id', $transportation_id)
            ->where('status', 1)
            ->orderBy('sort', 'asc')
            ->get();
    }
}
