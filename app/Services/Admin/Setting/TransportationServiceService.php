<?php

namespace App\Services\Admin\Setting;

use App\Models\TransportationService;

class TransportationServiceService extends SettingService
{
    protected $model = TransportationService::class;

    public function get_transportation_services(int $transportation_type_id)
    {
        return $this->model::where('transportation_type_id', $transportation_type_id)
            ->where('status', 1)
            ->orderBy('sort', 'asc')
            ->get();
    }
}
