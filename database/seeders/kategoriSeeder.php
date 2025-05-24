<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Nama_Kategori' => 'Makanan'],
            ['Nama_Kategori' => 'Minuman'],
            ['Nama_Kategori' => 'Alat'],
            ['Nama_Kategori' => 'Hewan'],
            // Tambahkan data lain sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel
        DB::table('kategori')->insert($data);
    }
}
