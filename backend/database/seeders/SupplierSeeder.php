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
                'phone_number' => '081234567890',
                'address' => 'Jl. Merdeka No. 12, Jakarta'
            ],
            [
                'name' => 'CV Sejahtera Abadi',
                'phone_number' => '085612345678',
                'address' => 'Jl. Raya Industri No. 5, Bandung'
            ],
            [
                'name' => 'UD Sumber Rezeki',
                'phone_number' => '082112223333',
                'address' => 'Jl. Sudirman No. 9, Surabaya'
            ],
            [
                'name' => 'PT Berkah Sentosa',
                'phone_number' => '081356789012',
                'address' => 'Jl. Gajah Mada No. 88, Yogyakarta'
            ],
            [
                'name' => 'CV Amanah Makmur',
                'phone_number' => '085234567890',
                'address' => 'Jl. Ahmad Yani No. 24, Semarang'
            ],
            [
                'name' => 'PT Nusantara Food Supply',
                'phone_number' => '081278912345',
                'address' => 'Jl. Pahlawan No. 14, Medan'
            ],
            [
                'name' => 'CV Bumi Lestari',
                'phone_number' => '082198765432',
                'address' => 'Jl. Diponegoro No. 17, Malang'
            ],
            [
                'name' => 'PT Sari Bumi Mandiri',
                'phone_number' => '081345678901',
                'address' => 'Jl. Kartini No. 33, Solo'
            ],
            [
                'name' => 'CV Mitra Pangan Sejahtera',
                'phone_number' => '085277889900',
                'address' => 'Jl. Cendrawasih No. 20, Makassar'
            ],
            [
                'name' => 'PT Prima Logistik',
                'phone_number' => '081367890123',
                'address' => 'Jl. Gatot Subroto No. 45, Palembang'
            ],
        ]);
    }
}
