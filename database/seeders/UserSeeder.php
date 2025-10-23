<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Az12345678'),
        ]);

        $operator1 = User::create([
            'name' => 'Əlimərdan Kərimov',
            'email' => 'e.kerimov@166.az',
            'password' => bcrypt('Az12345678'),
        ]);

        $operator2 = User::create([
            'name' => 'Çinarə Zülfüqarova',
            'email' => 'z.chinara@166.az',
            'password' => bcrypt('Az12345678'),
        ]);

        $admin->syncRoles('admin');
        $operator1->syncRoles('operator');
        $operator2->syncRoles('operator');
        $user_china = User::create([
            'name' => 'China',
            'email' => 'china@gmail.com',
            'password' => bcrypt('Az12345678')
        ]);

        $user_baku = User::create([
            'name' => 'Baku',
            'email' => 'baku@gmail.com',
            'password' => bcrypt('Az12345678'),
        ]);

        $user_china->syncRoles('operator');
        $user_baku->syncRoles('operator');
    }
}
