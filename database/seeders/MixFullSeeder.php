<?php

namespace Database\Seeders;

use App\Models\MixFull;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MixFullSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MixFull::create([
            'name' => 'Mix',
            'short_name' => 'mix',
            'sort' => 1,
            'status' => 1,
        ]);

        MixFull::create([
            'name' => 'Full',
            'short_name' => 'full',
            'sort' => 2,
            'status' => 1,
        ]);

        MixFull::create([
            'name' => 'Avtomobil',
            'short_name' => 'automobile',
            'sort' => 3,
            'status' => 1,
        ]);
    }
}
