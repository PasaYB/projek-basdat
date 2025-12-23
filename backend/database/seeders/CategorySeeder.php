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
                'slug' => 'daging',
                'description' => 'Berbagai jenis daging segar seperti ayam, sapi, dan ikan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sayuran',
                'slug' => 'sayuran',
                'description' => 'Sayur mayur segar untuk kebutuhan dapur.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bumbu',
                'slug' => 'bumbu',
                'description' => 'Bumbu dapur dasar dan rempah-rempah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman',
                'description' => 'Bahan dasar dan pelengkap untuk menu minuman.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sembako',
                'slug' => 'sembako',
                'description' => 'Bahan pokok seperti beras, minyak, dan gula.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
