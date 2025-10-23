<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\OrderFileService;
use App\Services\Admin\OrderService;

class OrderFileController extends Controller
{
    public function __construct(public OrderService $orderService, public OrderFileService $orderFileService) {}

    public function get_railway_bill(int $id)
    {
        $order = $this->orderService->getById($id);
        return $this->orderFileService->get_railway_bill($order);
    }

    public function get_declaration(int $id)
    {
        $order = $this->orderService->getById($id);
        return $this->orderFileService->get_declaration($order);
    }

    public function get_images(int $id)
    {
        $order = $this->orderService->getById($id);
        return $this->orderFileService->get_images($order);
    }

    public function delete_image(int $id)
    {
        $response = $this->orderFileService->delete_image($id);
        return response($response);
    }
}
