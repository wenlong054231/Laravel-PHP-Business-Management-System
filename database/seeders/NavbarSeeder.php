<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Navbar;

class NavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'header' =>'Client Management',
                'name' => 'Client List',
                'tablename' => 'customers',
                'route' => 'staff.client',
                'ordering' => 1,
            ],
            [
                'header' =>'Policy Management',
                'name' => 'Customer Policy List',
                'tablename' => 'customers_policies',
                'route' => 'customers.policy',
                'ordering' => 1,
            ],
            [
                'header' =>'Policy Management',
                'name' => 'Companies Policy List',
                'tablename' => 'companies_policies',
                'route' => 'companies.policy',
                'ordering' => 1,
            ],
            [
                'header' =>'',
                'name' => 'Companies Policy List',
                'tablename' => 'companies_policies',
                'route' => 'companies.policy',
                'ordering' => 1,
            ],
        ];
  
        foreach ($links as $key => $navbar) {
            Navbar::create($navbar);
        }
    }
}
