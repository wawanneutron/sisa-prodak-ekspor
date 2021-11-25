<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Nike',
            'last_name' => 'Ardila',
            'role'  => 'Admin Gudang',
            'email' => 'nikeardila@test.test',
            'password' => bcrypt('password')
        ]);

        User::create([
            'first_name' => 'Hamdan',
            'last_name' => 'ATT',
            'role'  => 'SPV',
            'email' => 'hamdan@test.test',
            'password' => bcrypt('password')

        ]);

        User::create([
            'first_name' => 'Jhonny',
            'last_name' => 'Iskandar',
            'role'  => 'Kepala Gudang',
            'email' => 'jhony@test.test',
            'password' => bcrypt('password')
        ]);
    }
}
