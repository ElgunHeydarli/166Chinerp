<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Source::create([
            'name' => 'Instagram',
            'status' => 1
        ]);

        Source::create([
            'name' => 'Facebook',
            'status' => 1
        ]);

        Source::create([
            'name' => 'Whatsapp',
            'status' => 1
        ]);
    }
}
