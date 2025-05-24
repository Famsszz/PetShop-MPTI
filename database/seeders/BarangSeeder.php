<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            //makanan:

            [
                'Nama_Barang' => 'wiskas',
                'Harga_Satuan' => 10000.00,
                'Status' => 'jual',
                'Stok_Jual' => 30,
                'ID_Kategori' => 1, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Makanan Kucing Standar ",
                'gambar' => 'wiskas.png',

            ],

            [
                'Nama_Barang' => 'Royale canin',
                'Harga_Satuan' => 30000.00,
                'Status' => 'jual',
                'Stok_Jual' => 30,
                'ID_Kategori' => 1, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Makanan kucing Mewah ",
                'gambar' => 'royaleCanin.jpg',

            ],

            [
                'Nama_Barang' => 'wiskas junior',
                'Harga_Satuan' => 5000.00,
                'Status' => 'jual',
                'Stok_Jual' => 50,
                'ID_Kategori' => 1, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Makanan untuk anak kucing standar ",
                'gambar' => 'wiskasSachet.jpg',

            ],

            [
                'Nama_Barang' => 'Hamster Natural Food',
                'Harga_Satuan' => 10000.00,
                'Status' => 'jual',
                'Stok_Jual' => 50,
                'ID_Kategori' => 1, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Makanan hamster ",
                'gambar' => 'HamsterNat.jpg',

            ],

            [
                'Nama_Barang' => 'Bolt',
                'Harga_Satuan' => 80000.00,
                'Status' => 'jual',
                'Stok_Jual' => 30,
                'ID_Kategori' => 1, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Makanan anjing ",
                'gambar' => 'boltKarung.jpg',

            ],

            [ 
                'Nama_Barang' => 'miltih',
                'Harga_Satuan' => 10000.00,
                'Status' => 'jual',
                'Stok_Jual' => 40,
                'ID_Kategori' => 1, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Makanan Burung ",
                'gambar' => 'miltih.jpg',

            ],

            //Hewan:

            [
                'Nama_Barang' => 'kucing',
                'Harga_Satuan' => 450000.00,
                'Status' => 'adopsi',
                'Stok_Jual' => 1,
                'ID_Kategori' => 4, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Hewan kucing ",
                'gambar' => 'kucingS.jpg',

            ],

            
            [
                'Nama_Barang' => 'kelinci',
                'Harga_Satuan' => 250000.00,
                'Status' => 'adopsi',
                'Stok_Jual' => 1,
                'ID_Kategori' => 4, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Hewan Kelinci ",
                'gambar' => 'kelinci1.jpg',

            ],
            
            [
                'Nama_Barang' => 'hamster',
                'Harga_Satuan' => 10000.00,
                'Status' => 'adopsi',
                'Stok_Jual' => 1,
                'ID_Kategori' => 4, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Hewan Hamster",
                'gambar' => 'hamster.jpg',

            ],
            
            [
                'Nama_Barang' => 'Cupcake',
                'Harga_Satuan' => 950000.00,
                'Status' => 'adopsi',
                'Stok_Jual' => 1,
                'ID_Kategori' => 4, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Hewan anjing",
                'gambar' => 'cupcake.jpg',

            ],

            [
                'Nama_Barang' => 'Beo',
                'Harga_Satuan' => 990000.00,
                'Status' => 'adopsi',
                'Stok_Jual' => 1,
                'ID_Kategori' => 4, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Hewan Burung",
                'gambar' => 'beo.jpg',

            ],
            

            //alat:

            [
                'Nama_Barang' => 'sisir hewan',
                'Harga_Satuan' => 10000.00,
                'Status' => 'jual',
                'Stok_Jual' => 10,
                'ID_Kategori' => 3, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Sisir untuk hewan ",
                'gambar' => 'sisirHewan.jpg',

            ],

            [
                'Nama_Barang' => 'tongkat bulu',
                'Harga_Satuan' => 15000.00,
                'Status' => 'jual',
                'Stok_Jual' => 10,
                'ID_Kategori' => 3, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " mainan untuk kucing ",
                'gambar' => 'tongkatBulu.jpg',

            ],

            [
                'Nama_Barang' => 'kandang',
                'Harga_Satuan' => 120000.00,
                'Status' => 'jual',
                'Stok_Jual' => 5,
                'ID_Kategori' => 3, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Sangkar Hewan ",
                'gambar' => 'kandangHewn.jpg',

            ],

            [
                'Nama_Barang' => 'Shampo kucing',
                'Harga_Satuan' => 10000.00,
                'Status' => 'jual',
                'Stok_Jual' => 40,
                'ID_Kategori' => 3, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Shampo untuk kucing ",
                'gambar' => 'shampoKucing.jpg',

            ],

            [
                'Nama_Barang' => 'Kalung kucing',
                'Harga_Satuan' => 7000.00,
                'Status' => 'jual',
                'Stok_Jual' => 20,
                'ID_Kategori' => 3, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " Kalung kucing ",
                'gambar' => 'kalungKucing.jpg',

            ],

            [
                'Nama_Barang' => 'rantai',
                'Harga_Satuan' => 13000.00,
                'Status' => 'jual',
                'Stok_Jual' => 10,
                'ID_Kategori' => 3, // Sesuaikan dengan ID_Kategori yang sudah ada
                'deskripsi' => " rantai untuk hewan ",
                'gambar' => 'rantaiAnj.jpg',

            ],

            // Tambahkan data lain sesuai kebutuhan
        ];

        DB::table('barang')->insert($data);
    }
}
