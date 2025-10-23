<?php

namespace Database\Seeders;

use App\Models\AboutBookingDate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutBookingDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutBookingDate::create([
            'date' => now()->addDays(5),
            'status' => 1
        ]);

        AboutBookingDate::create([
            'date' => now()->addDays(10),
            'status' => 1
        ]);

        AboutBookingDate::create([
            'date' => now()->addDays(15),
            'status' => 1
        ]);
    }
}
