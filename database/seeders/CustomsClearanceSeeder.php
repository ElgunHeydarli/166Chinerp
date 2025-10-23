<?php

namespace Database\Seeders;

use App\Models\CustomsClearance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomsClearanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomsClearance::create([
            'name' => 'Müştəri tərəfindən',
            'status' => 1,
        ]);

        CustomsClearance::create([
            'name' => 'Şirkət tərəfindən',
            'status' => 1,
        ]);
    }
}
