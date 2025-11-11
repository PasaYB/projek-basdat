<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Daging',
                'description' => 'Berbagai jenis daging segar seperti ayam, sapi, dan ikan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sayuran',
                'description' => 'Sayur mayur segar untuk kebutuhan dapur.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bumbu',
                'description' => 'Bumbu dapur dasar dan rempah-rempah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minuman',
                'description' => 'Bahan dasar dan pelengkap untuk menu minuman.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sembako',
                'description' => 'Bahan pokok seperti beras, minyak, dan gula.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
