<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Universitas; // Tambahkan ini

class UniversitasSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar kampus yang mau kita masukkan
        $kampus = [
            'Universitas Kristen Petra',
            'Universitas Airlangga (UNAIR)',
            'Institut Teknologi Sepuluh Nopember (ITS)',
            'Universitas Surabaya (UBAYA)'
        ];

        foreach ($kampus as $k) {
            Universitas::create(['nama_univ' => $k]);
        }
    }
}