<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'name' => 'Gözləmədə',
            'type' => 'pending',
            'sort' => 1,
            'status' => 1
        ]);

        Status::create([
            'name' => 'Yola çıxdı',
            'type' => 'pending',
            'sort' => 2,
            'status' => 1
        ]);

        Status::create([
            'name' => 'Xarici anbarda',
            'type' => 'pending',
            'sort' => 3,
            'status' => 1
        ]);

        Status::create([
            'name' => 'Azərbaycan gömrüyündə',
            'type' => 'pending',
            'sort' => 4,
            'status' => 1
        ]);

        Status::create([
            'name' => 'Azərbaycan anbarında',
            'type' => 'pending',
            'sort' => 5,
            'status' => 1
        ]);

        Status::create([
            'name' => 'Çatdırıldı',
            'type' => 'accepted',
            'sort' => 6,
            'status' => 1
        ]);

        Status::create([
            'name' => 'Ləğv olundu',
            'type' => 'rejected',
            'sort' => 7,
            'status' => 1
        ]);
    }
}
