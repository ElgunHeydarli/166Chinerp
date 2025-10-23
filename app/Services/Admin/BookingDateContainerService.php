<?php

namespace App\Services\Admin;

use App\Models\BookingDateContainer;
use App\Services\MainService;

class BookingDateContainerService extends MainService
{
    protected $model = BookingDateContainer::class;

    public function getBookingContainers(array $ids)
    {
        return $this->model::whereIn('id', $ids)->get();
    }

    public function getByContainerId(int $container_id)
    {
        return $this->model::where('container_id', $container_id)->get();
    }

    public function getByContainerIds(array $container_ids)
    {
        return $this->model::whereIn('container_id', $container_ids)->get();
    }

    public function getData(int $booking_date_id, int $container_id)
    {
        return $this->model::where('booking_date_id', '!=', $booking_date_id)->where('container_id', $container_id)->first();
    }

    public function getAll()
    {
        return $this->model::with('container')->where('status', 0)->get();
    }
}
