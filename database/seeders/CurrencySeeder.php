<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::create([
            'name' => 'Azərbaycan manatı',
            'code' => 'AZN',
            'symbol' => '₼',
            'sort' => 3
        ]);

        Currency::create([
            'name' => 'ABŞ dolları',
            'code' => 'USD',
            'symbol' => '$',
            'sort' => 1
        ]);

        Currency::create([
            'name'=>'Çin yuanı',
            'code'=>'CNY',
            'symbol'=>'¥',
            'sort'=>2
        ]);
    }
}
