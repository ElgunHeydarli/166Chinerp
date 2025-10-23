<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'name' => 'Bakı',
            'status' => 1
        ]);

        City::create([
            'name' => 'Sumqayıt',
            'status' => 1
        ]);
    }
}
