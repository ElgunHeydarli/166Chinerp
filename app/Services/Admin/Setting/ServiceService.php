<?php

namespace App\Services\Admin\Setting;

use App\Models\ExpenseType;
use App\Models\Service;

class ServiceService extends SettingService
{
    protected $model = Service::class;

    public function add_details(Service $service, array $data)
    {
        $service->details()->delete();
        foreach ($data['detail_name'] as $detail_name) {
            $service->details()->create([
                'name' => $detail_name
            ]);
        }
    }

    public function get_expense_types(int $service_id)
    {
        return ExpenseType::where(['service_id' => $service_id, 'status' => 1])
            ->orderBy('sort', 'asc')
            ->get();
    }
}
