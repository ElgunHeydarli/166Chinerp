<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(IncotermSeeder::class);
        $this->call(ContainerTypeSeeder::class);
        $this->call(CustomsClearanceSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(TransportationTypeSeeder::class);
        $this->call(TransportationServiceSeeder::class);
        $this->call(TransportationSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(PaymentTypeSeeder::class);
        $this->call(StationSeeder::class);
        $this->call(ContainerPriceSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(PriceTypeSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(MixFullSeeder::class);
        $this->call(ExpenseTypeSeeder::class);
        $this->call(CarTypeSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
