<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductType::create([
            'name' => 'Avtomobil',
            'status' => 1
        ]);

        ProductType::create([
            'name' => 'Digər',
            'status' => 1
        ]);
    }
}
