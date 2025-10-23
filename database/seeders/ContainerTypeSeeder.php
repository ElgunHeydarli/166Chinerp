<?php

namespace Database\Seeders;

use App\Models\ContainerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContainerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContainerType::create([
            'name' => '45GP',
            'max_size' => 74,
            'status' => 1
        ]);

        ContainerType::create([
            'name' => '40HQ',
            'max_size' => 68,
            'status' => 1
        ]);

        ContainerType::create([
            'name' => '40GP',
            'max_size' => 58,
            'status' => 1
        ]);

        ContainerType::create([
            'name' => '20GP',
            'max_size' => 30,
            'status' => 1
        ]);
    }
}
