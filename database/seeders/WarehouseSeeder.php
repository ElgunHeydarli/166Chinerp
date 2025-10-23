<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warehouse::create([
            'name' => 'Anbar 1',
            'status' => 1
        ]);

        Warehouse::create([
            'name' => 'Anbar 2',
            'status' => 1
        ]);

        Warehouse::create([
            'name' => 'Anbar 3',
            'status' => 1
        ]);
    }
}
