<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {

            if (auth()->user()) {
                if (auth()->user()->email_verified_at == NULL) {
                    return redirect('/verify-email');
                }
            }

            $Peran = Auth()->user()->Peran;

            if ($Peran == 'Pelanggan') {

                // Mengambil data dengan kategori 'Alat'
                $dataAlat = DB::table('view_detail_barang')
                    ->select('*')
                    ->where('Nama_Kategori', '=', 'Alat') 
                    ->paginate(4);

                // Mengambil data dengan kategori 'Makanan' 
                $dataMakanan = DB::table('view_detail_barang')
                    ->select('*')
                    ->where('Nama_Kategori', '=', 'Makanan') 
                    ->paginate(4);

                // Mengambil data hewan untuk view yang berbeda
                $dataHewan = DB::table('view_detail_hewanadopsi')
                    ->select('*')
                    ->paginate(4);
                    
                return view('index', compact('dataAlat', 'dataMakanan', 'dataHewan'));
            } else if ($Peran == 'Kasir') {
                return view('kasir.kasir-dashboard');
            } else if ($Peran == 'Admin') {
                return view('admin.admin-dashboard');
            } else return view('index');
        }
    }
}
