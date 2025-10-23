<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        District::create([
            'name' => 'Yasamal',
            'city_id' => 1,
            'status' => 1,
        ]);

        District::create([
            'name' => 'Qaradağ',
            'city_id' => 1,
            'status' => 1,
        ]);
    }
}
