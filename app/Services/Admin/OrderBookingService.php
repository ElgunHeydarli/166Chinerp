<?php

namespace App\Services\Admin;

use App\Models\Booking;
use App\Services\MainService;

class OrderBookingService extends MainService
{
    protected $model = Booking::class;

    public function getOrdersByDate()
    {
        return $this->model::groupBy('date')->select('date')->get();
    }
}
