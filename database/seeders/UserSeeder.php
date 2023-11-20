<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Chow Wen Long',
                'phone' => '1234567890',
                'email' => 'test1@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('asd'),
                'role' => 'staff',
            ],
            [
                'name' => 'Chow Wen Long',
                'phone' => '1234567890',
                'email' => 'test2@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('asd'),
                'role' => 'admin',
            ],
        ]);
    }
}
