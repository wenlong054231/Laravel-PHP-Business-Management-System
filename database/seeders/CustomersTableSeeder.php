<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Define the column names and their sample data
         $columnData = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone' => '1234567890',
                'email' => 'john@example.com',
                'address' => '123 Main St',
                'city' => 'New York',
                'state' => 'NY',
                'zip_code' => '10001',
                'country' => 'USA',
                'identification_number' => '910941249',
                'gender' => 'Male',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'phone' => '9876543210',
                'email' => 'jane@example.com',
                'address' => '456 Elm St',
                'city' => 'Los Angeles',
                'state' => 'CA',
                'zip_code' => '90001',
                'country' => 'USA',
                'identification_number' => '9123091293',
                'gender' => 'Female',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ],
            // Add more data records as needed
        ];
        // Insert the sample data into the customers table
        DB::table('customers')->insert($columnData);
    }

    
}
