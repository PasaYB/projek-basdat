<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123'),        
        ]);
        
        User::factory()->create([
            'name' => 'ahmad',
            'email' => 'ahmad@example.com',
            'password' => bcrypt('123'),        
        ]);
        
        User::factory()->create([
            'name' => 'raihan',
            'email' => 'raihan@example.com',
            'password' => bcrypt('123'),        
        ]);

        User::factory()->create([
            'name' => 'fuad',
            'email' => 'fuad@example.com',
            'password' => bcrypt('123'),        
        ]);
    }
}
