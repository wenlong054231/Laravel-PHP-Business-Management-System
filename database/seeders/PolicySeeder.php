<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Policy;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Retrieve all customers
        $customers = Customer::all();

        // Create policies for each customer
        foreach ($customers as $customer) {
            Policy::create([
                'customer_id' => $customer->id,
                'coverage' => 0,
                'insurance_type' => 'Type',
                'first_name' => $customer->first_name,
                'last_name' => $customer->last_name,
                'identification_number' => $customer->identification_number,
                'gender' => $customer->gender,
                'car_plate' => 'Plate',
                'expired_date' => now()->addYear(),
                'registered_date' => now(),
            ]);
        }
    }
}
