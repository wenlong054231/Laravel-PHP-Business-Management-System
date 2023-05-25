<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // This will create a user with the 'admin' role
        User::factory()->admin()->create();
       
        // This will create a user with the 'manager' role
        $staff = User::factory()->staff()->create();

    }
}
