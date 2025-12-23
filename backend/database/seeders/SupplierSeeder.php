<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'PT Maju Jaya',
                'slug' => 'pt-maju-jaya',
                'phone_number' => '081234567890',
                'address' => 'Jl. Merdeka No. 12, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CV Sejahtera Abadi',
                'slug' => 'cv-sejahtera-abadi',
                'phone_number' => '085612345678',
                'address' => 'Jl. Raya Industri No. 5, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'UD Sumber Rezeki',
                'slug' => 'ud-sumber-rezeki',
                'phone_number' => '082112223333',
                'address' => 'Jl. Sudirman No. 9, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PT Berkah Sentosa',
                'slug' => 'pt-berkah-sentosa',
                'phone_number' => '081356789012',
                'address' => 'Jl. Gajah Mada No. 88, Yogyakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CV Amanah Makmur',
                'slug' => 'cv-amanah-makmur',
                'phone_number' => '085234567890',
                'address' => 'Jl. Ahmad Yani No. 24, Semarang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PT Nusantara Food Supply',
                'slug' => 'pt-nusantara-food-supply',
                'phone_number' => '081278912345',
                'address' => 'Jl. Pahlawan No. 14, Medan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CV Bumi Lestari',
                'slug' => 'cv-bumi-lestari',
                'phone_number' => '082198765432',
                'address' => 'Jl. Diponegoro No. 17, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PT Sari Bumi Mandiri',
                'slug' => 'pt-sari-bumi-mandiri',
                'phone_number' => '081345678901',
                'address' => 'Jl. Kartini No. 33, Solo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CV Mitra Pangan Sejahtera',
                'slug' => 'cv-mitra-pangan-sejahtera',
                'phone_number' => '085277889900',
                'address' => 'Jl. Cendrawasih No. 20, Makassar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PT Prima Logistik',
                'slug' => 'pt-prima-logistik',
                'phone_number' => '081367890123',
                'address' => 'Jl. Gatot Subroto No. 45, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
