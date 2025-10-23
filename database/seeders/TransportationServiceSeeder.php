<?php

namespace Database\Seeders;

use App\Models\TransportationService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportationServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransportationService::create([
            'name' => 'Daşınma',
            'status' => 1,
            'transportation_type_id' => 1,
        ]);

        TransportationService::create([
            'name' => 'Daşınma',
            'status' => 1,
            'transportation_type_id' => 2,
        ]);
    }
}
