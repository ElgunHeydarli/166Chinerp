<?php

namespace App\Services\Admin;

use App\Models\AbandonedCargo;
use App\Services\MainService;

class AbandonedCargoService extends MainService
{
    protected $model = AbandonedCargo::class;

    public function getAllByStatus(string $status)
    {
        return $this->model::where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
