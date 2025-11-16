<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UnitSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\EmployeeSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\IngredientSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            EmployeeSeeder::class,
            SupplierSeeder::class,
            UnitSeeder::class,
            IngredientSeeder::class,
        ]);
    }
}
