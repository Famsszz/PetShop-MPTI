<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\barangjual;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Penitipan_hewan;

use function PHPUnit\Framework\returnSelf;


class PageController extends Controller
{
    public function makanan()
    {
        $mkn = 'Makanan';
        $makanan = DB::table('view_detail_barang')
            ->select('*')->where('Nama_Kategori', $mkn)->get();
        return view('page.makanan', compact('makanan'));
    }

    public function alat()
    {
        $alt = 'Alat';
        $alat = DB::table('view_detail_barang')
            ->select('*')->where('Nama_Kategori', $alt)->get();
        return view('page.alat', compact('alat'));
    }

    public function keranjang()
    {
        return view('page.keranjang', [
            "keranjang" => Keranjang::where('Pengguna', '=', auth()->user()->Nama_Pengguna)
                ->whereIn('status', ['Keranjang','Menunggu_Pembayaran', 'Gagal'])
                ->orderBy('Dibeli', 'desc')
                ->get(),

            "keranjangss" => Keranjang::where('Pengguna', '=', auth()->user()->Nama_Pengguna)
            ->whereIn('status', ['Keranjang'])
            ->orderBy('Dibeli', 'desc')
            ->get(),
        ]);
    }


    public function deletekeranjang(Keranjang $krjg)
    {
        $quantity = $krjg->jumlah_stok_dipesan;
        $barang = $krjg->ID_Barang;

        if ($krjg->status != "Gagal") {
            $stokJualSaatIni = Barang::where('ID_Barang', $barang)->value('Stok_Jual');
            $stokjualbalik = $quantity + $stokJualSaatIni;
            DB::select('call stokjualbalikkasir(?,?)', array($barang, $stokjualbalik));
        }
        Barangjual::where('ID_Barang', $barang)->delete();

        Keranjang::destroy($krjg->ID_Keranjang);
        
        session()->flash('success', 'Item barang keranjang telah dihapus');
        return redirect()->back();
    }

    public function deletepenitipan(Penitipan_hewan $pntpn)
    {
        $pntpn->delete();
        session()->flash('success', 'Penitipan ' . $pntpn->Nama_Hewan . ' telah dibatalkan');
        return redirect()->back();
    }

    public function penitipanpage()
    {
        return view('page.detail.penitipan', [
            "penitipan" => Penitipan_hewan::where('status', 'Berhasil')
            ->where('Nama_Pengguna', auth()->user()->Nama_Pengguna)
            ->orderBy('Dipesan', 'desc')->get(),
        ]);
    }

    public function pengambilanbarang()
    {
        return view('page.detail.pengambilan', [
            "pengambilan" => barangjual::where('status', 'Berhasil')
            ->where('Pengguna', auth()->user()->Nama_Pengguna)
            ->orderBy('Dibeli', 'desc')->get(),
        ]);
    }

    public function adopsi()
    {
        $adopsi = DB::table('view_detail_hewanadopsi')
            ->select('*')->get();
        return view('page.adopsi', compact('adopsi'));
    }

    public function penitipan()
    {
        return view('page.penitipan', [
            "penitipan" => Penitipan_hewan::where('Nama_Pengguna', '=', auth()->user()->Nama_Pengguna)
            ->whereIn('status', ['Menunggu_Pembayaran', 'Gagal'])
                ->orderby('Dipesan', 'desc')->get()
        ]);
    }

    public function kirimpenitipan(Request $request)
    {
        $user_id = auth()->user()->ID_Pengguna;

        // Periksa apakah sudah ada ID Transaksi dalam sesi
        if (!$request->session()->has('id_transaksi') || !$request->session()->has('jenis_penitipan')) {
            // Jika tidak ada, buat transaksi baru
            $id_transaksi_baru = $this->buatTransaksiBaruPenitipan($user_id);
        
            // Simpan ID Transaksi dalam sesi
            $request->session()->put('id_transaksi', $id_transaksi_baru);
            $request->session()->put('jenis_penitipan', "Penitipan");
        } else {
            // Jika sudah ada, gunakan ID Transaksi yang sudah ada
            $id_transaksi_baru = $request->session()->get('id_transaksi');
        
            // Periksa status di tabel penitipan
            $status_penitipan = DB::table('penitipan_hewan')
                ->where('ID_Pengguna', $user_id)
                ->value('status');
        
            // Jika status adalah "Berhasil", buat transaksi baru
            if ($status_penitipan == 'Berhasil' || $status_penitipan == 'Batal') {
                $id_transaksi_baru = $this->buatTransaksiBaruPenitipan($user_id);
        
                // Simpan ID Transaksi baru dalam sesi
                $request->session()->put('id_transaksi', $id_transaksi_baru);
            }
        }

        $request->validate([
            'gambar' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp'
        ]);
        $file = $request->file('gambar');
        if ($file) {
            $judul = $request->get('gambar');
            $extension = $file->getClientOriginalExtension();
            $nama_file = 'file_' . date('YmdHis') . '.' . $extension;
            $file->move(public_path('berkas_ujis'), $nama_file);
            $berkas = '' . $nama_file;
        }
        DB::select('call tambahformpenitipan(?,?,?,?,?,?,?,?,?,?)', array($id_transaksi_baru, $request->get('ID_Pengguna'), $request->get('Nama_Pengguna'), $request->get('Peran'), $request->get('Nama_Hewan'), $request->get('Tanggal'), $request->get('Lama_Hari'), $request->get('Jenis_Layanan'), $request->get('Harga'), $berkas));
        session()->flash('success', 'Form pentipan berhasil ditambahkan ke penitipan.');
        return redirect()->back();
    }


    public function terimasemuakeranjang(Request $request)
{
    $user_id = auth()->user()->ID_Pengguna;

    // Periksa apakah sudah ada ID Transaksi dalam sesi
    if (!$request->session()->has('id_transaksi') || !$request->session()->has('jenis_barang')) {
        // Jika tidak ada, buat transaksi baru
        $id_transaksi_baru = $this->buatTransaksiBaruBarang($user_id);

        // Simpan ID Transaksi dalam sesi
        $request->session()->put('id_transaksi', $id_transaksi_baru);
        $request->session()->put('jenis_barang', "Barang");
    } else {
        // Jika sudah ada, gunakan ID Transaksi yang sudah ada
        $id_transaksi_baru = $request->session()->get('id_transaksi');

        // Periksa status di tabel barangjual
        $status_barang = DB::table('barangjual')
            ->where('ID_Pengguna', $user_id)
            ->value('status');

        // Jika status adalah "Berhasil", buat transaksi baru
        if ($status_barang == 'Menunggu_Pembayaran' || $status_barang == 'Batal' || $status_barang == 'Berhasil') {
            $id_transaksi_baru = $this->buatTransaksiBaruBarang($user_id);

            // Simpan ID Transaksi baru dalam sesi
            $request->session()->put('id_transaksi', $id_transaksi_baru);
        }
    }

    $quantities = $request->get('quantity');
    
        foreach ($quantities as $key => $quantity) {
            if ($quantity > 0) {
                DB::select('call tambahkeranjangbarangdantransaksi(?,?,?,?,?,?,?,?,?,?,?,?,?)', array(
                    $id_transaksi_baru,
                    $request->get('ID_Barang')[$key],
                    $request->get('ID_Pengguna')[$key],
                    $request->get('ID_Kategori')[$key],
                    $request->get('Nama_Barang')[$key],
                    $request->get('Nama_Pengguna')[$key],
                    $request->get('Peran')[$key],
                    $request->get('Nama_Kategori')[$key],
                    $request->get('Harga_Satuan')[$key],
                    $request->get('deskripsi')[$key],
                    $quantity,
                    $request->get('gambar')[$key],
                    $request->get('status')[$key]
                ));
                DB::select('call perbaruistok(?,?)', array(
                    $request->get('ID_Barang')[$key],
                    $quantity
                ));
    
                $status = "Menunggu_Pembayaran";
                DB::select('call terimasemuakeranjang(?,?)', array($request->get('ID_Pengguna')[$key], $status));
            } else {
                session()->flash('error', 'Stok tidak boleh kosong');
            }
        }
        // Update the ID_Transaksi in the keranjang table
    DB::table('keranjang')
    ->where('ID_Pengguna', $user_id)
    ->where('status', 'Menunggu_Pembayaran')
    ->update(['ID_Transaksi' => $id_transaksi_baru]);
    
        session()->flash('success', 'Menunggu Pembayaran');
        return redirect()->back();
    }



    public function kirimDanUpdate(Request $request)
{
        $quantity = $request->get('quantity');
        $ID_Transaksi = $request->get('ID_Transaksi') ?? null;
        // Pastikan quantity tidak kurang dari atau sama dengan 0
        if ($quantity > 0) {
            DB::select('call tambahkeranjangbarang(?,?,?,?,?,?,?,?,?,?,?,?,?)', array($ID_Transaksi, $request->get('ID_Barang'), $request->get('ID_Pengguna'), $request->get('ID_Kategori'), $request->get('Nama_Barang'), $request->get('Nama_Pengguna'), $request->get('Peran'), $request->get('Nama_Kategori'), $request->get('Harga_Satuan'), $request->get('deskripsi'), $quantity, $request->get('gambar'), $request->get('status')));
            DB::select('call perbaruistok(?,?)', array(
                $request->get('ID_Barang'), $quantity
            ));
            session()->flash('success', 'Barang berhasil ditambahkan ke keranjang');
        } else {
            session()->flash('error', 'Stok tidak boleh kosong');
        }
        return redirect()->back();
    }




    // public function kirimDanUpdate(Request $request)
    // {
    //     $user_id = auth()->user()->ID_Pengguna;

    //     // Periksa apakah sudah ada ID Transaksi dalam sesi
    //     if (!$request->session()->has('id_transaksi') || !$request->session()->has('Jenis')) {
    //         // Jika tidak ada, buat transaksi baru
    //         $id_transaksi_baru = $this->buatTransaksiBaruBarang($user_id);
        
    //         // Simpan ID Transaksi dalam sesi
    //         $request->session()->put('id_transaksi', $id_transaksi_baru);
    //         $request->session()->put('Jenis', "Barang");
    //     } else {
    //         // Jika sudah ada, gunakan ID Transaksi yang sudah ada
    //         $id_transaksi_baru = $request->session()->get('id_transaksi');
        
    //         // Periksa status di tabel barangjual
    //         $status_barang = DB::table('barangjual')
    //             ->where('ID_Pengguna', $user_id)
    //             ->value('status');
        
    //         // Jika status adalah "Berhasil", buat transaksi baru
    //         if ($status_barang == 'Berhasil' || $status_barang == 'Batal') {
    //             $id_transaksi_baru = $this->buatTransaksiBaru($user_id);
        
    //             // Simpan ID Transaksi baru dalam sesi
    //             $request->session()->put('id_transaksi', $id_transaksi_baru);
    //         }
    //     }
        
    //     $quantity = $request->get('quantity');
    //     // Pastikan quantity tidak kurang dari atau sama dengan 0
    //     if ($quantity > 0) {
    //         DB::select('call tambahkeranjangbarang(?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id_transaksi_baru, $request->get('ID_Barang'), $request->get('ID_Pengguna'), $request->get('ID_Kategori'), $request->get('Nama_Barang'), $request->get('Nama_Pengguna'), $request->get('Peran'), $request->get('Nama_Kategori'), $request->get('Harga_Satuan'), $request->get('deskripsi'), $quantity, $request->get('gambar'), $request->get('status')));
    //         DB::select('call perbaruistok(?,?)', array(
    //             $request->get('ID_Barang'), $quantity
    //         ));
    //         session()->flash('success', 'Barang berhasil ditambahkan ke keranjang');
    //     } else {
    //         session()->flash('error', 'Stok tidak boleh kosong');
    //     }
    //     return redirect()->back();
    // }

    private function buatTransaksiBaruBarang()
    {
        date_default_timezone_set('Asia/Jakarta');

        // Buat transaksi baru dan kembalikan ID Transaksi
        $id_transaksi_baru = DB::table('transaksi')->insertGetId([
            'Tanggal_Transaksi' => now(),
            'Jenis' => "Barang"
        ]);

        return $id_transaksi_baru;
    }

    private function buatTransaksiBaruPenitipan()
    {
        date_default_timezone_set('Asia/Jakarta');

        // Buat transaksi baru dan kembalikan ID Transaksi
        $id_transaksi_baru = DB::table('transaksi')->insertGetId([
            'Tanggal_Transaksi' => now(),
            'Jenis' => "Penitipan"
        ]);

        return $id_transaksi_baru;
    }
}