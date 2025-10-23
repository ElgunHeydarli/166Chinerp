<?php

namespace Database\Seeders;

use App\Models\TransportationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransportationType::create([
            'name' => 'İdxal',
            'status' => 1
        ]);

        TransportationType::create([
            'name' => 'İxrac',
            'status' => 2
        ]);
    }
}
