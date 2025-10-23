<?php

namespace Database\Seeders;

use App\Models\ContainerPrice;
use App\Models\ContainerType;
use App\Models\Station;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContainerPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $container_types = ContainerType::where('status', 1)->get();
        $stations = Station::where('status', 1)->get();

        foreach ($container_types as $container_type) {
            foreach ($stations as $station) {
                ContainerPrice::create([
                    'container_type_id' => $container_type->id,
                    'station_id' => $station->id,
                    'price' => 0
                ]);
            }
        }
    }
}
