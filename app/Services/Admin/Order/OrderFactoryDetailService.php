<?php

namespace App\Services\Admin\Order;

use App\Models\OrderFactory;

class OrderFactoryDetailService
{
    public function add_factory_detail(OrderFactory $order_factory, array $data)
    {
        if (is_null($order_factory->detail)) {
            $order_factory->detail()->create($data);
        } else {
            $order_factory->detail()->update($data);
        }
    }
}
