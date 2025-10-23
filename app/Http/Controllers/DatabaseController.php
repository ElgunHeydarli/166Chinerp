<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\OrderFactory;
use App\Models\OrderStatusChange;
use App\Services\Admin\Order\OrderServiceService;
use App\Services\Admin\OrderService;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function __construct(
        public OrderService $orderService,
        public OrderServiceService $orderServiceService
    ) {

    }

    public function index()
    {
        // $orders = $this->orderService->getByStatuses([OrderStatus::CONFIRMED, OrderStatus::EXECUTE, OrderStatus::FINISHED]);
        // foreach ($orders as $order) {
        //     $this->orderService->add_receives($order);
        // }

        // $order_services = $this->orderServiceService->getAll();
        // foreach ($order_services as $order_service) {
        //     $order = $this->orderService->getById($order_service->order_id);
        //     $this->orderServiceService->update($order_service->id, ['order_item_id' => $order->items()->first()->id]);
        // }

        $order_factories = OrderFactory::all();
        foreach ($order_factories as $order_factory) {
            $order = $this->orderService->getById($order_factory->order_id);
            $order_factory->update([
                'order_item_id' => $order->items()->first()?->id,
            ]);
        }

        return 'ok';
    }
}
