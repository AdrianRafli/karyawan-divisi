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
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '08123456789',
            'division_id' => 1, // IT
        ]);
    
        Employee::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '08198765432',
            'division_id' => 2, // HR
        ]);
    }
}
