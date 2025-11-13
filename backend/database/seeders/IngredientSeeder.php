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
                'unit' => 'kg',
                'category_id' => 1,
                'supplier_id' => 1,
                'price_per_unit' => 120000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daging Ayam Fillet',
                'unit' => 'kg',
                'category_id' => 1,
                'supplier_id' => 2,
                'price_per_unit' => 65000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ikan Kembung',
                'unit' => 'kg',
                'category_id' => 1,
                'supplier_id' => 3,
                'price_per_unit' => 55000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Udang Kupas',
                'unit' => 'kg',
                'category_id' => 1,
                'supplier_id' => 4,
                'price_per_unit' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daging Cincang',
                'unit' => 'kg',
                'category_id' => 1,
                'supplier_id' => 5,
                'price_per_unit' => 95000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // === Kategori 2: Sayuran ===
            [
                'name' => 'Wortel',
                'unit' => 'kg',
                'category_id' => 2,
                'supplier_id' => 6,
                'price_per_unit' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brokoli',
                'unit' => 'kg',
                'category_id' => 2,
                'supplier_id' => 7,
                'price_per_unit' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kacang Panjang',
                'unit' => 'ikat',
                'category_id' => 2,
                'supplier_id' => 8,
                'price_per_unit' => 7000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bayam',
                'unit' => 'ikat',
                'category_id' => 2,
                'supplier_id' => 9,
                'price_per_unit' => 6000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bawang Daun',
                'unit' => 'ikat',
                'category_id' => 2,
                'supplier_id' => 10,
                'price_per_unit' => 8000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // === Kategori 3: Bumbu ===
            [
                'name' => 'Bawang Merah',
                'unit' => 'kg',
                'category_id' => 3,
                'supplier_id' => 1,
                'price_per_unit' => 32000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bawang Putih',
                'unit' => 'kg',
                'category_id' => 3,
                'supplier_id' => 2,
                'price_per_unit' => 28000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabe Merah',
                'unit' => 'kg',
                'category_id' => 3,
                'supplier_id' => 3,
                'price_per_unit' => 40000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lengkuas',
                'unit' => 'kg',
                'category_id' => 3,
                'supplier_id' => 4,
                'price_per_unit' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jahe',
                'unit' => 'kg',
                'category_id' => 3,
                'supplier_id' => 5,
                'price_per_unit' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kunyit',
                'unit' => 'kg',
                'category_id' => 3,
                'supplier_id' => 6,
                'price_per_unit' => 18000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // === Kategori 4: Minuman ===
            [
                'name' => 'Susu Cair',
                'unit' => 'liter',
                'category_id' => 4,
                'supplier_id' => 7,
                'price_per_unit' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sirup Rasa Melon',
                'unit' => 'liter',
                'category_id' => 4,
                'supplier_id' => 8,
                'price_per_unit' => 18000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kopi Bubuk',
                'unit' => 'gram',
                'category_id' => 4,
                'supplier_id' => 9,
                'price_per_unit' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teh Celup',
                'unit' => 'kotak',
                'category_id' => 4,
                'supplier_id' => 10,
                'price_per_unit' => 12000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gula Cair',
                'unit' => 'liter',
                'category_id' => 4,
                'supplier_id' => 1,
                'price_per_unit' => 16000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // === Kategori 5: Bahan Pokok ===
            [
                'name' => 'Beras Premium',
                'unit' => 'kg',
                'category_id' => 5,
                'supplier_id' => 2,
                'price_per_unit' => 14000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gula Pasir',
                'unit' => 'kg',
                'category_id' => 5,
                'supplier_id' => 3,
                'price_per_unit' => 16000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minyak Goreng',
                'unit' => 'liter',
                'category_id' => 5,
                'supplier_id' => 4,
                'price_per_unit' => 22000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tepung Terigu',
                'unit' => 'kg',
                'category_id' => 5,
                'supplier_id' => 5,
                'price_per_unit' => 13000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Garam Halus',
                'unit' => 'kg',
                'category_id' => 5,
                'supplier_id' => 6,
                'price_per_unit' => 8000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
