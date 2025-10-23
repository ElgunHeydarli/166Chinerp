<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\OrderBookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function __construct(public OrderBookingService $orderBookingService) {}

    public function report()
    {
        $bookings = $this->orderBookingService->getOrdersByDate();
        return $bookings;
        return view('back.pages.container.report');
    }
}
