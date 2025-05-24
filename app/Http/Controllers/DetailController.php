<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;

class DetailController extends Controller
{
    // public function index() {
    //     return view ('detail', [
    //         'makanan'=> Detail::all()
    //     ]);
    // }
    public function keranjangpenitipan(){
        return view ('keranjang.keranjangpenitipan');
    }
    public function formpenitipan(){
        return view ('keranjang.formpenitipan');
    }
    public function statusKeranjang(){
        return view ('keranjang.statusKeranjang');
    }

    // view
    public function detailbarang($item)
    {
        $viewbarang = DB::table('view_detail_barang')
        ->select('*')->where('ID_Barang', $item)->first();

        $barangJuals = Barang::where('ID_Barang', $item)->first();
        return view('page.detail.detail-barang', compact('viewbarang', 'barangJuals'));
    }


    public function detailhewan($item)
    {
        $viewhewan = DB::table('view_detail_hewanadopsi')
        ->select('*')->where('ID_Barang', $item)->first();
        return view('page.detail.detail-hewan', compact('viewhewan'));
    }

//     public function detailbarang($barangId)
// {
//     $viewbarang = DB::table('view_detail_barang')
//         ->select('*')
//         ->where('id_barang', $barangId)
//         ->first();
//     return view('detail', compact('viewbarang'));
// }

}