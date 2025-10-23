<?php

namespace App\Services\Admin\Order;

use App\Models\OrderFactory;

class OrderFactoryVinCodeService
{

    public function add_vin_codes(OrderFactory $orderFactory, array $vinCodes)
    {
        $orderFactory->vin_codes()->delete();
        foreach ($vinCodes as $vinCode) {
            $orderFactory->vin_codes()->create(['vin_code' => $vinCode]);
        }
    }
}
