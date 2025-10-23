<?php

namespace App\Services\Admin;

use App\Models\ContainerPrice;
use App\Services\MainService;

class ContainerPriceService extends MainService
{
    protected $model = ContainerPrice::class;

    public function filter($limit, $container_type_id = null, $station_id = null)
    {
        $query = $this->model::query()->with('container_type', 'station');
        if (!is_null($container_type_id)) $query->where('container_type_id', $container_type_id);
        if (!is_null($station_id)) $query->where('station_id', $station_id);
        return $query->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function getByIdWithDetails(int $id)
    {
        return $this->model::with('container_type', 'station')->find($id);
    }

    public function get_price(?int $container_type_id, ?int $station_id)
    {
        return $this->model::query()
            ->where([
                'container_type_id' => $container_type_id,
                'station_id' => $station_id
            ])
            ->first()?->price ?? 0;
    }
}
