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
            'slug' => 'pasa',
            'password' => bcrypt('123'),
            'address' => 'Sleman'        
        ]);
        
        Employee::create([
            'name' => 'belvan',
            'slug' => 'belvan',
            'password' => bcrypt('123'),        
        ]);
        
        Employee::create([
            'name' => 'marsel',
            'slug' => 'marsel',
            'password' => bcrypt('123'),        
        ]);

        Employee::create([
            'name' => 'fano',
            'slug' => 'fano',
            'password' => bcrypt('123'),        
        ]);

        Employee::create([
            'name' => 'laras',
            'slug' => 'laras',
            'password' => bcrypt('123'),        
        ]);
    }
}
