<?php

namespace App\Services\Admin\Order;

use App\Models\Factory;
use Illuminate\Http\Request;

class OrderFactoryService
{

    public function getFactoryData(Request $request): array
    {
        return $request->only([
            'factory_name',
            'factory_phone',
            'factory_cube',
            'factory_delivery_point',
            'box_count',
            'palette_count',
            'product_type_id',
            'vin_code',
            'factory_note',
        ]);
    }

    public function getFactory(array $data): Factory
    {
        $factory = Factory::where(['name' => $data['factory_name'], 'phone' => $data['factory_phone']])->first();
        if (is_null($factory)) {
            $factory = Factory::create([
                'name' => $data['factory_name'],
                'phone' => $data['factory_phone'],
            ]);
        }
        return $factory;
    }

    public function getFactoryIds(array $data): array
    {
        $factory_ids = [];
        foreach ($data['factory_name'] ?? [] as $key => $factory_name) {
            $factory = $this->getFactory(['factory_name' => $factory_name, 'factory_phone' => $data['factory_phone'][$key]]);
            $factory_ids[] = $factory->id;
        }

        return $factory_ids;
    }
}
