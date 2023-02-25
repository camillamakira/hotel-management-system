<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Mark',
            'last_name' => 'Mosobo',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'phone_no' => '0790659917',
            'password' => Hash::make('12345'),
        ]);

        User::create([
            'first_name' => 'Camilla',
            'last_name' => 'Makira',
            'email' => 'makiracamilla@gmail.com',
            'role'=> 'manager',
            'phone_no' => '0768196097',
            'password' => Hash::make('12345'),
        ]);

        User::create([
            'first_name' => 'Kelly',
            'last_name' => 'Makira',
            'email' => 'kellymakira@gmail.com',
            'role' => 'user',
            'phone_no' => '0724067996',
            'password' => Hash::make('12345'),
        ]);
    }
}
