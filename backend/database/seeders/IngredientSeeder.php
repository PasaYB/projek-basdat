<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ingredients')->insert([
            // === Kategori 1: Daging & Ikan ===
            [
                'name' => 'Daging Sapi Segar',
                'unit_id' => 1,
                'category_id' => 1,
                'supplier_id' => 1,
                'price_per_unit' => 120000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daging Ayam Fillet',
                'unit_id' => 1,
                'category_id' => 1,
                'supplier_id' => 2,
                'price_per_unit' => 65000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ikan Kembung',
                'unit_id' => 1,
                'category_id' => 1,
                'supplier_id' => 3,
                'price_per_unit' => 55000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Udang Kupas',
                'unit_id' => 1,
                'category_id' => 1,
                'supplier_id' => 4,
                'price_per_unit' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daging Cincang',
                'unit_id' => 1,
                'category_id' => 1,
                'supplier_id' => 5,
                'price_per_unit' => 95000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // === Kategori 2: Sayuran ===
            [
                'name' => 'Wortel',
                'unit_id' => 1,
                'category_id' => 2,
                'supplier_id' => 6,
                'price_per_unit' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brokoli',
                'unit_id' => 1,
                'category_id' => 2,
                'supplier_id' => 7,
                'price_per_unit' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kacang Panjang',
                'unit_id' => 1,
                'category_id' => 2,
                'supplier_id' => 8,
                'price_per_unit' => 7000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bayam',
                'unit_id' => 1,
                'category_id' => 2,
                'supplier_id' => 9,
                'price_per_unit' => 6000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bawang Daun',
                'unit_id' => 1,
                'category_id' => 2,
                'supplier_id' => 10,
                'price_per_unit' => 8000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // === Kategori 3: Bumbu ===
            [
                'name' => 'Bawang Merah',
                'unit_id' => 1,
                'category_id' => 3,
                'supplier_id' => 1,
                'price_per_unit' => 32000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bawang Putih',
                'unit_id' => 1,
                'category_id' => 3,
                'supplier_id' => 2,
                'price_per_unit' => 28000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabe Merah',
                'unit_id' => 1,
                'category_id' => 3,
                'supplier_id' => 3,
                'price_per_unit' => 40000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lengkuas',
                'unit_id' => 1,
                'category_id' => 3,
                'supplier_id' => 4,
                'price_per_unit' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jahe',
                'unit_id' => 1,
                'category_id' => 3,
                'supplier_id' => 5,
                'price_per_unit' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kunyit',
                'unit_id' => 1,
                'category_id' => 3,
                'supplier_id' => 6,
                'price_per_unit' => 18000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // === Kategori 4: Minuman ===
            [
                'name' => 'Susu Cair',
                'unit_id' => 2,
                'category_id' => 4,
                'supplier_id' => 7,
                'price_per_unit' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sirup Rasa Melon',
                'unit_id' => 2,
                'category_id' => 4,
                'supplier_id' => 8,
                'price_per_unit' => 18000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kopi Bubuk',
                'unit_id' => 3,
                'category_id' => 4,
                'supplier_id' => 9,
                'price_per_unit' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teh Celup',
                'unit_id' => 4,
                'category_id' => 4,
                'supplier_id' => 10,
                'price_per_unit' => 12000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gula Cair',
                'unit_id' => 2,
                'category_id' => 4,
                'supplier_id' => 1,
                'price_per_unit' => 16000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // === Kategori 5: Bahan Pokok ===
            [
                'name' => 'Beras Premium',
                'unit_id' => 1,
                'category_id' => 5,
                'supplier_id' => 2,
                'price_per_unit' => 14000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gula Pasir',
                'unit_id' => 1,
                'category_id' => 5,
                'supplier_id' => 3,
                'price_per_unit' => 16000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minyak Goreng',
                'unit_id' => 2,
                'category_id' => 5,
                'supplier_id' => 4,
                'price_per_unit' => 22000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tepung Terigu',
                'unit_id' => 1,
                'category_id' => 5,
                'supplier_id' => 5,
                'price_per_unit' => 13000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Garam Halus',
                'unit_id' => 1,
                'category_id' => 5,
                'supplier_id' => 6,
                'price_per_unit' => 8000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
