<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExpenseType::create([
            'name' => 'Xərc 1',
            'sort' => 1,
            'status' => 1,
        ]);

        ExpenseType::create([
            'name' => 'Xərc 2',
            'sort' => 2,
            'status' => 1,
        ]);

        ExpenseType::create([
            'name' => 'Xərc 3',
            'sort' => 3,
            'status' => 1,
        ]);
    }
}
