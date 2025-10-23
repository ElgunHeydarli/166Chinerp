<?php

namespace Database\Seeders;

use App\Models\PriceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PriceType::create([
            'name' => 'Railway bill',
            'status' => 1
        ]);

        PriceType::create([
            'name' => 'Declaration fee',
            'status' => 1
        ]);

        PriceType::create([
            'name' => 'Broker fee',
            'status' => 1
        ]);

        PriceType::create([
            'name' => 'Yükləmə məbləği',
            'status' => 1
        ]);

        PriceType::create([
            'name' => 'Boşaltma məbləği',
            'status' => 1
        ]);

        PriceType::create([
            'name' => 'Digər',
            'status' => 1
        ]);
    }
}
