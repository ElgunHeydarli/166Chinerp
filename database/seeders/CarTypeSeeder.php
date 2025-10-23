<?php

namespace Database\Seeders;

use App\Models\CarType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarType::create([
            'name' => 'Sedan',
            'sort' => 1,
            'status' => 1
        ]);

        CarType::create([
            'name' => 'SUV',
            'sort' => 2,
            'status' => 1
        ]);
    }
}
