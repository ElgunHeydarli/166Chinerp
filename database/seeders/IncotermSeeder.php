<?php

namespace Database\Seeders;

use App\Models\Incoterm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncotermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Incoterm::create([
            'name' => 'EXW',
            'status' => 1,
        ]);

        Incoterm::create([
            'name' => 'FOB',
            'status' => 1,
        ]);

        Incoterm::create([
            'name' => 'FCA',
            'status' => 1,
        ]);
    }
}
