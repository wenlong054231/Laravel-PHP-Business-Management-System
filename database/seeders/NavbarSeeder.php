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
                'route' => 'staff.client',
                'ordering' => 1,
            ],
            [
                'header' =>'Client Management',
                'name' => 'Client Add',
                'route' => 'staff.clientadd',
                'ordering' => 2,
            ],
            [
                'header' =>'Policy Management',
                'name' => 'Policy List',
                'route' => 'staff.policy',
                'ordering' => 1,
            ],
        ];
  
        foreach ($links as $key => $navbar) {
            Navbar::create($navbar);
        }
    }
}
