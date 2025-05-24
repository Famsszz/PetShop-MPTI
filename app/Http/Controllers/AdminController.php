<?php

namespace App\Http\Controllers;

use App\Models\barangjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pengguna;
use App\Models\User;
use App\Models\Log_barang;
use App\Models\Log_pengguna;
use App\Models\Log_keranjang;
use App\Models\Log_penitipan_hewan;
use App\Models\Log_Stok_Masuk;
use App\Models\Penitipan_hewan;

class AdminController extends Controller
{
    public function dashboardadmin(){
        return view ('admin.admin-dashboard');
    }
    public function datapengguna(){
        $pelanggan = User::where('peran', '=', 'pelanggan')
        ->paginate(5);
        return view ('admin.data-pengguna', compact('pelanggan'));
    }

    public function deletedatapengguna(User $datapelanggan){
        User::destroy($datapelanggan->ID_Pengguna);
        
        session()->flash('success', 'Pengguan berhail dihapus');
        return redirect()->back();
    }

    
    public function searchpelanggan(Request $request)
    {
        $search = $request->input('search');

        $pelanggan = User::where('peran', '=', 'pelanggan')
                            ->where('Nama_Akun', 'like', '%' . $search . '%')
                            ->orWhere('Nama_Pengguna', 'like', '%' . $search . '%')
                            ->paginate(5);
        return view('admin.data-pengguna', compact('pelanggan'));
    }

    public function admindatabarang(){
        $databarang = DB::table('view_detail_barang')
        ->select('*')
        ->paginate(5);
        return view ('admin.admin-data-barang', compact('databarang'));
    }

    

    public function searchbarang(Request $request)
    {
        $search = $request->input('search');

        $databarang = DB::table('view_detail_barang')
                            ->where('Nama_Barang', 'like', '%' . $search . '%')
                            ->orWhere('Nama_Kategori', 'like', '%' . $search . '%')
                            ->paginate(5);
        return view('admin.admin-data-barang', compact('databarang'));
    }

    public function admindataadopsi(){
        $dataadopsi = DB::table('view_detail_hewanadopsi')
        ->select('*')
        ->paginate(10);
        return view ('admin.admin-data-adopsi', compact('dataadopsi'));
    }

    public function datastok(){
        $datastok = DB::table('view_barang_masuk')
        ->select('*')
        ->paginate(5);
        return view ('admin.admin-data-stok', compact('datastok'));
    }

    public function searchstokadmin(Request $request)
    {
        $search = $request->input('search');

        $datastok = DB::table('view_barang_masuk')
                            ->where('Nama_Barang', 'like', '%' . $search . '%')
                            ->paginate(5);
        return view('admin.admin-data-stok', compact('datastok'));
    }

    public function datapesanan(){
        return view ('admin.data-pesanan');
    }
    public function datakasir(){
        $kasir = User::where('peran', '=', 'Kasir')->get();
        return view ('admin.data-kasir', compact('kasir'));
    }
    public function tambahkasir(){
        return view ('admin.tambah-kasir');
    }
    public function tambahkasirkedatabase(Request $request) {
        DB::select('call tambahKasir(?,?,?,?,?)', array($request->get('nama'), $request->get('usname'), bcrypt($request->get('password')), $request->get('nohp'), $request->get('email') ));
        return view ('admin.tambah-kasir');
    }

    public function editkasir($idp){
        $kasir = User::find($idp);
        return view ('admin.edit-kasir', compact('kasir'));
    }


    
    public function editkasirdb(Request $request, $idp)
    { 
        $kasir = User::find($idp);
        // dd($barang->gambar);
        if(
            $request->nama == $kasir->Nama_Akun &&
            $request->usname == $kasir->Nama_Pengguna &&
            $request->nohp == $kasir->No_Telp &&
            $request->email == $kasir->email 
        )
        {
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }
        if($request->nama != $kasir->Nama_Akun){
            $request->validate([
                'nama' => ['required', 'string', 'max:255']
            ]);
        }
        if($request->usname != $kasir->Nama_Pengguna){
            $request->validate([
                'usname' => ['required', 'string', 'max:255']
            ]);
        }
        if($request->nohp != $kasir->No_Telp){
            $request->validate([
                'nohp' => ['required', 'string', 'max:255']
            ]);
        }
        if($request->email != $kasir->email){
            $request->validate([
                'email' => ['required', 'string', 'max:255']
            ]);
        }

        try {
            DB::select('call editKasir(?,?,?,?,?)', array($idp, $request->nama, $request->usname, $request->nohp, $request->email));

            return redirect()->route('data_kasir')->with('success', 'Data Kasir berhasil dieditkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Gagal mengedit data Kasir. Error: ' . $e->getMessage());
        }
    }

    public function hapuskasir(Request $request)
    {
        User::destroy($request->ID_Pengguna);
        return redirect('/datakasir')->with('success', 'Barang berhasil dihapus');
    }

    //table log
    public function log_barang()
    {
        $logBarang = Log_barang::paginate(10);

        return view('admin.table_log.log-barang', compact('logBarang'));
    }
    public function log_pengguna()
    {
        $logPengguna = Log_pengguna::paginate(10);
    
        return view('admin.table_log.log-pengguna', compact('logPengguna'));
    }
    public function log_penitipan_hewan()
    {
        $logPenitipanHewan = Log_penitipan_hewan::paginate(10);
        return view('admin.table_log.log-penitipan-hewan', compact('logPenitipanHewan'));
    }
    
    public function log_transaksi()
    {
        return view('admin.table_log.log-transaksi');   
    }
    public function log_book()
    {
        $logKeranjang = Log_keranjang::paginate(10);
        return view('admin.table_log.log-keranjang', compact('logKeranjang'));
    }
    public function log_jual()
    {
        $logStokJual = DB::table('log_stok')->paginate(10);
    
        return view('admin.table_log.log-stok-jual', compact('logStokJual'));
    }
    public function log_masuk()
    {
        $logStokMasuk = Log_Stok_Masuk::paginate(10);
        return view('admin.table_log.log-stok-masuk', compact('logStokMasuk'));
    }
    public function barangterjual()
    {
        $terjual = barangjual::where('status', 'Selesai')
            ->orderBy('Dibeli', 'desc')
            ->paginate(5);
    
        return view('admin.riwayat-barang-terjual', compact('terjual'));
    }    

    public function hapusbarangterjual(barangjual $tjwl)
    {
        barangjual::destroy($tjwl->ID_barangjual);
        return redirect()->back()->with('success', 'Riwayat barang terjual telah dihapus');
    }

    public function riwayatpenitipan()
    {
        $penitipan = Penitipan_hewan::where('status', 'Selesai')
            ->orderBy('Dipesan', 'desc')
            ->paginate(5);
        return view('admin.riwayat-penitipan', compact('penitipan'));
    }

    public function hapuspenitipan(Penitipan_hewan $pntpn)
    {
        Penitipan_hewan::destroy($pntpn->ID_Penitipan);
        return redirect()->back()->with('success', 'Riwayat penitipan telah dihapus');
    }
}