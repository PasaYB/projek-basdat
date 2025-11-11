<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Employee::create([
            'name' => 'pasa',
            'password' => bcrypt('123'),
            'address' => 'Sleman'        
        ]);
        
        Employee::create([
            'name' => 'belvan',
            'password' => bcrypt('123'),        
        ]);
        
        Employee::create([
            'name' => 'marsel',
            'password' => bcrypt('123'),        
        ]);

        Employee::create([
            'name' => 'fano',
            'password' => bcrypt('123'),        
        ]);

        Employee::create([
            'name' => 'laras',
            'password' => bcrypt('123'),        
        ]);
    }
}
