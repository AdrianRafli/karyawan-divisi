<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::create(['name' => 'IT']);
        Division::create(['name' => 'HR']);
        Division::create(['name' => 'Finance']);
    }
}
