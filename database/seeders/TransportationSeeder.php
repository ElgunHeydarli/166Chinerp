<?php

namespace Database\Seeders;

use App\Models\Transportation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transportation::create([
            'name' => 'Dəmiryolu',
            'status' => 1,
            'transportation_service_id' => 1,
        ]);

        Transportation::create([
            'name' => 'Hava yolları',
            'status' => 1,
            'transportation_service_id' => 1,
        ]);
    }
}
