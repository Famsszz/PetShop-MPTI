<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    // public function index() {
    //     return view ('index');
    // }

    // public function index()
    // {
    //     // Mengambil data dengan kategori 'Alat'
    //     $dataAlat = DB::table('view_detail_barang')
    //         ->select('*')
    //         ->where('Nama_kategori', '=', 'Alat') // Ganti 'ID_Kategori_Alats' dengan ID_Kategori dari 'Alat'
    //         ->paginate(10);
    
    //     return view('index', compact('dataAlat','dataMakanan','dataHewan'));
    // }

    public function index()
{
    // Mengambil data dengan kategori 'Alat'
    $dataAlat = DB::table('view_detail_barang')
        ->select('*')
        ->where('Nama_Kategori', '=', 'Alat') // Ganti 'Nama_Kategori' dengan nama yang sesuai di tabel 'kategori'
        ->paginate(4);

    // Mengambil data dengan kategori 'Makanan'
    $dataMakanan = DB::table('view_detail_barang')
        ->select('*')
        ->where('Nama_Kategori', '=', 'Makanan') // Ganti 'Nama_Kategori' dengan nama yang sesuai di tabel 'kategori'
        ->paginate(4);

    // Mengambil data hewan untuk view yang berbeda
    $dataHewan = DB::table('view_detail_hewanadopsi')
        ->select('*')
        ->paginate(4);

    // Mengirimkan data ke tiga view
    return view('index', compact('dataAlat', 'dataMakanan', 'dataHewan'));
}



}

