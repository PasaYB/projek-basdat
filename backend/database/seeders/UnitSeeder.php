<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('units')->insert([
            [
                'code' => 'kg',
                'name' => 'Kilogram',
                'slug' => 'kilogram',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'l',
                'name' => 'Liter',
                'slug' => 'liter',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'g',
                'name' => 'Gram',
                'slug' => 'gram',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'box',
                'name' => 'Kotak',
                'slug' => 'kotak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
