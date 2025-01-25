<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name' => 'Budi Agra',
            'email' => 'budi@gmail.com',
            'phone' => '08123456789',
            'division_id' => 1, // IT
        ]);
    
        Employee::create([
            'name' => 'Sarah Wajito',
            'email' => 'sarah@gmail.com',
            'phone' => '08198765432',
            'division_id' => 2, // HR
        ]);

        Employee::create([
            'name' => 'Eka Putra',
            'email' => 'eka@gmail.com',
            'phone' => '08198765432',
            'division_id' => 3, // Finance
        ]);

        Employee::create([
            'name' => 'Nabil Satria',
            'email' => 'nabil@gmail.com',
            'phone' => '08198765432',
            'division_id' => 1,
        ]);
    }
}
