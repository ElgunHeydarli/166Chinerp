<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Station::create([
            'name' => 'Station 1',
            'status' => 1
        ]);

        Station::create([
            'name' => 'Station 2',
            'status' => 1
        ]);

        Station::create([
            'name' => 'Station 3',
            'status' => 3
        ]);
    }
}
