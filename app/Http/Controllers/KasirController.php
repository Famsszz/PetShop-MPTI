<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\barangjual;
use App\Models\Stok_masuk;
use App\Models\Penitipan_hewan;
use App\Models\Keranjang;
// use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    public function dashboardkasir()
    {
        return view('kasir.kasir-dashboard');
    }
    public function datastokkasir()
    {
        $datastokkasir = DB::table('view_barang_masuk')
            ->select('*')
            ->paginate(5);
        return view('kasir.data-stok', compact('datastokkasir'));
    }
    public function caristok(Request $request)
    {
        $search = $request->input('search');

        $datastokkasir = DB::table('view_barang_masuk')
            ->where('Nama_Barang', 'like', '%' . $search . '%')
            ->paginate(5);
        return view('kasir.data-stok', compact('datastokkasir'));
    }



    public function datapesanankasir()
    {
        return view('kasir.data-pesanan', [
            "keranjang" => barangjual::where('status', 'Menunggu_Pembayaran')
                ->orderBy('Dibeli', 'desc')->get(),
        ]);
    }

    public function detailkeranjang(barangjual $krjg)
    {
        return view('kasir.detail.detail-keranjang', [
            "keranjang" => barangjual::where('ID_Transaksi', '=', $krjg->ID_Transaksi)
            ->whereIn('status', ['Menunggu_Pembayaran', 'Offline'])
                ->orderBy('Dibeli', 'desc')->get(),
        ]);
    }


    public function detailpenitipan(Penitipan_hewan $pntpn)
    {
        
        return view('kasir.detail.detail-penitipan', [
            "penitipan" => Penitipan_hewan::where('Nama_Pengguna', '=', $pntpn->Nama_Pengguna)
                ->whereIn('status', ['Menunggu_Pembayaran', 'Offline'])
                ->orderBy('Tanggal', 'desc')->get(),
        ]);
    }

    public function datapenitipankasir()
    {
        return view('kasir.data-penitipan-kasir', [
            "penitipan" => Penitipan_hewan::whereIn('status', ['Menunggu_Pembayaran', 'Offline'])
                ->orderby('Dipesan', 'desc')->get()
        ]);
    }

    public function statusterimapenitipan(Request $request)
    {
        $ID_Transaksi = $request->input('ID_Transaksi');
        
        // Periksa ID_Transaksi sebelum menggunakan
        if ($ID_Transaksi) {
            $penitipan = Penitipan_hewan::where('ID_Transaksi', $ID_Transaksi)->first();
            if ($penitipan) {
                $statusBaru = ($penitipan->status == 'Offline') ? 'Selesai' : 'Berhasil';
    
                DB::select('CALL updatestatuspenitipan(?, ?)', array($penitipan->ID_Penitipan, $statusBaru));
    
                session()->flash('success', 'Penitipan telah dibayar    ');
                return redirect()->back();
            } else {
                session()->flash('error', 'Penitipan tidak ditemukan');
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'ID_Transaksi tidak valid');
            return redirect()->back();
        }
    }
    // public function terimaSemua2(Request $req)
    // {
    //     $statusBaru = 'Berhasil';
    //     DB::select('CALL updatestatusterimasemua2(?,?)', array($req->get('ID_Transaksi'), $statusBaru));
    //     session()->flash('success', 'Barang telah dibayar semua');
    //     return redirect()->back();
    // }


    public function statustolakpenitipan(Penitipan_hewan $pntpn)
    {
        $statusBaru = 'Gagal';
        DB::select('CALL updatestatuspenitipan(?, ?)', [$pntpn->ID_Penitipan, $statusBaru]);
        session()->flash('error', 'Barang gagal dipesan');
        return redirect()->back();
    }

    public function pesananpenitipan()
    {
        return view('kasir.detail.penitipan', [
            "penitipan" => Penitipan_hewan::where('status', 'Berhasil')
                ->where('Peran', '<>', 'Kasir')
                ->orderBy('Dipesan', 'desc')->get(),
        ]);
    }


    public function pengambilanselesai(barangjual $krjg)
    {
        $statusBaru = 'Selesai';
        DB::select('CALL updatestatusselesaibarang(?, ?)', [$krjg->ID_barangjual, $statusBaru]);
        session()->flash('success', 'Barang telah diterima');
        return redirect()->back();
    }

    public function penitipanselesai(Penitipan_hewan $p)
    {
        $statusBaru = 'Selesai';
        DB::select('CALL updatestatusselesaipenitipan(?, ?)', [$p->ID_Penitipan, $statusBaru]);
        session()->flash('success', 'Penitipan telah selesai');
        return redirect()->back();
    }

    public function statusterima(barangjual $krjg)
    {
        $statusBaru = 'Berhasil';
        DB::select('CALL updatestatus(?, ?)', [$krjg->ID_barangjual, $statusBaru]);
        session()->flash('success', 'Barang telah dibayar');
        return redirect()->back();
    }

    public function statustolak(Keranjang $krjg)
    {
        $statusBaru = 'Gagal';
        DB::select('CALL updatestatuskeranjang(?, ?)', [$krjg->ID_Keranjang, $statusBaru]);
        $quantity = $krjg->jumlah_stok_dipesan;
        $barang = $krjg->ID_Barang;
        $stokJualSaatIni = Barang::where('ID_Barang', $barang)->value('Stok_Jual');
        $stokjualbalik = $quantity + $stokJualSaatIni;
        DB::select('call stokjualbalikkasir(?,?)', array($barang, $stokjualbalik));
        session()->flash('error', 'Barang gagal dipesan');
        return redirect()->back();
    }
    public function statustolakbarangjual(barangjual $krjg)
    {
        $statusBaru = 'Gagal';
        DB::select('CALL updatestatus(?, ?)', [$krjg->ID_barangjual, $statusBaru]);
        $quantity = $krjg->jumlah_stok_dipesan;
        $barang = $krjg->ID_Barang;
        $stokJualSaatIni = Barang::where('ID_Barang', $barang)->value('Stok_Jual');
        $stokjualbalik = $quantity + $stokJualSaatIni;
        DB::select('call stokjualbalikkasir(?,?)', array($barang, $stokjualbalik));
        session()->flash('error', 'Barang gagal dipesan');
        return redirect()->back();
    }

    public function barangjual()
    {
        // Menampilkan data keranjang
        $keranjang = Keranjang::whereIn('status', ['Offline'])
            ->orderBy('Dibeli', 'desc')
            ->get();
        
        // Menampilkan data barang
        $barangJuals = Barang::paginate(5);
    
        $keranjangss = Keranjang::where('Pengguna', '=', auth()->user()->Nama_Pengguna)
            ->whereIn('status', ['Offline'])
            ->orderBy('Dibeli', 'desc')
            ->get();
    
        return view('kasir.barang-jual', compact('barangJuals', 'keranjang', 'keranjangss'));
    }


    public function terimasemua(Request $request)
    {
        $user_id = auth()->user()->ID_Pengguna;
    
        // Periksa apakah sudah ada ID Transaksi dalam sesi
        if (!$request->session()->has('id_transaksi') || !$request->session()->has('Jenis')) {
            // Jika tidak ada, buat transaksi baru
            $id_transaksi_baru = $this->buatTransaksiBaruBarang($user_id);
    
            // Simpan ID Transaksi dalam sesi
            $request->session()->put('id_transaksi', $id_transaksi_baru);
            $request->session()->put('Jenis', "Barang");
        } else {
            // Jika sudah ada, gunakan ID Transaksi yang sudah ada
            $id_transaksi_baru = $request->session()->get('id_transaksi');
    
            // Periksa status di tabel barangjual
            $status_barang = DB::table('barangjual')
                ->where('ID_Pengguna', $user_id)
                ->value('status');
    
            // Jika status adalah "Berhasil", buat transaksi baru
            if ($status_barang == 'Batal' || $status_barang == 'Selesai') {
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
                // DB::select('call perbaruistok(?,?)', array(
                //     $request->get('ID_Barang')[$key],
                //     $quantity
                // ));

                $status = "Selesai";
                DB::select('call terimasemuakeranjangoffline(?,?)', array($request->get('ID_Pengguna')[$key], $status));

                $status = "Selesai";
                DB::select('call terimasemuakeranjangbarangjual(?,?)', array($request->get('ID_Pengguna')[$key], $status));
            } else {
                session()->flash('error', 'Stok tidak boleh kosong');
            }
        }
    
        session()->flash('success', 'Barang telah dibayar');
        return redirect()->back();
    }


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


    public function terimaSemua2(Request $req)
    {
        $statusBaru = 'Berhasil';
        DB::select('CALL updatestatusidtransaksiterimasemua(?,?)', array($req->get('ID_Transaksi'), $statusBaru));
        session()->flash('success', 'Barang telah dibayar semua');
        return redirect()->back();
    }


    // public function terimasemuapentipan()
    // {
    //     $statusBaru = 'Berhasil';
    //     DB::select('CALL updatestatuspenitipanterimasemua(?)', [$statusBaru]);
    //     session()->flash('success', 'Barang telah dibayar semua');
    //     return redirect()->back();
    // }


    // public function kirimbarangjual(Request $request)
    // {

    //     $quantity = $request->get('quantity');

    //     // Pastikan quantity tidak kurang dari atau sama dengan 0
    //     if ($quantity > 0) {
    //         DB::select('call tambahkeranjangbarang(?,?,?,?,?,?,?,?,?,?,?,?)', array($request->get('ID_Transaksi'),$request->get('ID_Barang'),$request->get('ID_Pengguna'),$request->get('ID_Kategori'),$request->get('Nama_Barang'),$request->get('Nama_Pengguna'),$request->get('Nama_Kategori'),$request->get('Harga_Satuan'),$request->get('deskripsi'),$quantity, $request->get('gambar'), $request->get('status')));
    //         DB::select('call perbaruistok(?,?)', array(
    //         $request->get('ID_Barang'), $quantity));
    //         session()->flash('success', 'Barang berhasil ditambahkan ke keranjang');
    //     } else {
    //         session()->flash('error', 'Stok tidak boleh kosong');
    //     }
    //     return redirect()->back();
    // }

    public function pengambilanbarang()
    {
        return view('kasir.detail.pengambilan', [
            "pengambilan" => barangjual::where('status', 'Berhasil')
                ->where('Peran', '<>', 'Kasir')
                ->orderBy('Dibeli', 'desc')->get(),
        ]);
    }


    public function databarang()
    {
        $databarang = DB::table('view_detail_barang')
            ->select('*')
            ->paginate(5);
        return view('kasir.data-barang', compact('databarang'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $databarang = DB::table('view_detail_barang')
            ->where('Nama_Barang', 'like', '%' . $search . '%')
            ->orWhere('Nama_Kategori', 'like', '%' . $search . '%')
            ->paginate(5);
        return view('kasir.data-barang', compact('databarang'));
    }


    public function tambahbarang()
    {
        // Get only the specified categories
        $allowedCategories = ['Alat', 'minuman', 'makanan'];
        $kategori = Kategori::whereIn('Nama_Kategori', $allowedCategories)->get();

        return view('kasir.tambah-barang', compact('kategori'));
    }


    public function tambahbarangdatabase(Request $request)
    {
        try {
            $request->validate([
                'gambar' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp'
            ]);

            $file = $request->file('gambar');

            if ($file) {
                $extension = $file->getClientOriginalExtension();
                $nama_file = 'file_' . date('YmdHis') . '.' . $extension;
                $file->move(public_path('berkas_ujis'), $nama_file);
                $berkas = '' . $nama_file;
            }

            DB::select('call tambahBarangJual(?,?,?,?,?,?)', array($request->get('nama'), $request->get('harga'), $request->get('stok'), $request->get('kategori'), $request->get('deskripsi'),  $berkas));

            return redirect()->route('data.barang')->with('success', 'Data Barang berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('data.barang')->with('error', 'Gagal menambahkan data Barang. Error: ' . $e->getMessage());
        }
    }


    public function datahewanadopsi()
    {
        $dataadopsi = DB::table('view_detail_hewanadopsi')
            ->select('*')
            ->paginate(10);
        return view('kasir.data-hewan-adopsi', compact('dataadopsi'));
    }


    public function tambahhewanadopsi()
    {
        $kategoriHewan = Kategori::where('Nama_Kategori', 'Hewan')->first();
        return view('kasir.tambah-hewan-adopsi', compact('kategoriHewan'));
    }


    public function tambahhewandatabase(Request $request)
    {
        try {
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

            DB::select('call tambahHewanAdopsi(?,?,?,?,?,?)', array($request->get('nama'), $request->get('harga'), $request->get('stok'), $request->get('kategori'), $request->get('deskripsi'),  $berkas));

            return redirect()->route('datahewan.adopsi')->with('success', 'Data Hewan Adopsi berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('datahewan.adopsi')->with('error', 'Gagal menambahkan data Hewan Adopsi. Error: ' . $e->getMessage());
        }
    }

    public function tambahstokmasuk()
    {
        $nabarang = Barang::where('ID_Kategori', 1)
                    ->orWhere('ID_Kategori', 2)
                    ->orWhere('ID_Kategori', 3)
                    ->get();
        return view('kasir.tambah-stok-masuk', compact('nabarang'));
    }

    public function tambahstokmasukpecah()
    {
        $nabarang = Barang::where('ID_Kategori', 1)
                    ->orWhere('ID_Kategori', 2)
                    ->get();
        return view('kasir.tambah-stok-masuk-pecah', compact('nabarang'));
    }



    public function tambahstokmasukdatabase(Request $request)
    {
        // Validasi input
        $request->validate([
            'stok' => 'required|integer|min:1', // Memastikan stok adalah angka integer dan lebih dari 0
        ]);
    
        // Memanggil stored procedure hanya jika validasi berhasil
        DB::select('call tambahStokMasuk(?,?)', array($request->get('nabarang'), $request->get('stok')));
    
        // Redirect dengan data baru
        return redirect()->route('data.stok.masuk')->with('nabarang', Barang::SELECT('*')->get());
    }
    

    public function tambahStokmasukpecahdb(Request $request)
    {

        $result = DB::selectOne('SELECT pecah_stok(?, ?) AS stok', [$request->stok, $request->jumlah_pecah]);

        // Ambil nilai hasil fungsi dari hasil query
        $stokBarangPecah = $result->stok;
        // Panggil prosedur tambahStokMasuk
        DB::select('call tambahStokMasuk(?,?)', array($request->get('nabarang'), $stokBarangPecah));

        // Panggil fungsi pecah_stok dan simpan hasilnya dalam variabel


        // Tampilkan pesan sukses atau error sesuai kebutuhan
        return redirect()->route('data.stok.masuk', compact('stokBarangPecah'))->with('nabarang', Barang::SELECT('*')->get());
    }



    public function tambahpenitipan()
    {
        return view('kasir.tambah-penitipan');
    }



    public function hapus(Request $request)
    {
        Barang::destroy($request->ID_Barang);
        return redirect('/databarang')->with('success', 'Barang berhasil dihapus');
    }

    public function hapushewanadopsi(Request $request)
    {
        Barang::destroy($request->ID_Barang);
        return redirect('/datahewanadopsi')->with('success', 'Barang berhasil dihapus');
    }

    public function hapusstokmasuk(Request $request)
    {
        Stok_masuk::destroy($request->ID_StokMasuk);
        return redirect('/datastokkasir')->with('success', 'Barang berhasil dihapus');
    }

    public function editbarang($idb)
    {
        $barang = Barang::find($idb);
        $allowedCategories = ['Alat', 'minuman', 'makanan'];
        $status = Barang::select(DB::raw("DISTINCT(Status)"))->pluck('Status');
        $kategori = Kategori::whereIn('Nama_Kategori', $allowedCategories)->get();
        return view('kasir.edit-barang', compact('barang', 'kategori', 'allowedCategories', 'status'));
    }

    public function editbarangdatabase(Request $request, $idb)
    {
        $barang = Barang::find($idb);
        // dd($barang->gambar);
        if (
            $request->nama == $barang->Nama_Barang &&
            $request->harga == $barang->Harga_Satuan &&
            $request->stok == $barang->Stok_Jual &&
            $request->kategori == $barang->Nama_Kategori &&
            $request->deskripsi == $barang->deskripsi &&
            $request->gambar == NULL
        ) {
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }
        $rules = [];

        if ($request->nama != $barang->Nama_Barang) {
            $request->validate([
                'nama' => ['required', 'string', 'max:255']
            ]);
        }
        if ($request->harga != $barang->Harga_Satuan) {
            $request->validate([
                'harga' => ['required', 'string', 'max:255']
            ]);
        }
        if ($request->stok != $barang->Stok_Jual) {
            $request->validate([
                'stok' => ['required', 'string', 'max:255']
            ]);
        }
        if ($request->kategori != $barang->Nama_Kategori) {
            $request->validate([
                'kategori' => ['required', 'string', 'max:255']
            ]);
        }

        if ($request->gambar != NULL) {
            $request->validate([
                'gambar' => ['required', 'mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp']
            ]);
            $file = $request->file('gambar');

            if ($file) {
                $extension = $file->getClientOriginalExtension();
                $nama_file = 'file_' . date('YmdHis') . '.' . $extension;
                $file->move(public_path('berkas_ujis'), $nama_file);
                $berkas = '' . $nama_file;
                // dd($berkas);
            }
        } else {
            $berkas = $barang->gambar;
        }
        try {
            DB::select('call editBarangjual(?,?,?,?,?,?,?)', array($idb, $request->nama, $request->harga, $request->stok, $request->kategori, $request->deskripsi, $berkas));

            return redirect()->route('data.barang')->with('success', 'Data Barang berhasil dieditkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Gagal mengedit data Barang. Error: ' . $e->getMessage());
        }
    }

    public function edithewanadopsi($idb)
    {
        $barang = Barang::find($idb);
        $allowedCategories = ['Alat', 'minuman', 'makanan', 'hewan'];
        $status = Barang::select(DB::raw("DISTINCT(Status)"))->pluck('Status');
        $kategori = Kategori::whereIn('Nama_Kategori', $allowedCategories)->get();
        return view('kasir.edit-hewan-adopsi', compact('barang', 'kategori', 'allowedCategories', 'status'));
    }

    public function edithewanadopsidb(Request $request, $idb)
    {
        $barang = Barang::find($idb);
        // dd($barang->gambar);
        if (
            $request->nama == $barang->Nama_Barang &&
            $request->harga == $barang->Harga_Satuan &&
            $request->stok == $barang->Stok_Jual &&
            $request->kategori == $barang->Nama_Kategori &&
            $request->deskripsi == $barang->deskripsi &&
            $request->gambar == NULL
        ) {
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }
        $rules = [];

        if ($request->nama != $barang->Nama_Barang) {
            $request->validate([
                'nama' => ['required', 'string', 'max:255']
            ]);
        }
        if ($request->harga != $barang->Harga_Satuan) {
            $request->validate([
                'harga' => ['required', 'string', 'max:255']
            ]);
        }
        if ($request->stok != $barang->Stok_Jual) {
            $request->validate([
                'stok' => ['required', 'string', 'max:255']
            ]);
        }
        if ($request->kategori != $barang->Nama_Kategori) {
            $request->validate([
                'kategori' => ['required', 'string', 'max:255']
            ]);
        }

        if ($request->gambar != NULL) {
            $request->validate([
                'gambar' => ['required', 'mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp']
            ]);
            $file = $request->file('gambar');

            if ($file) {
                $extension = $file->getClientOriginalExtension();
                $nama_file = 'file_' . date('YmdHis') . '.' . $extension;
                $file->move(public_path('berkas_ujis'), $nama_file);
                $berkas = '' . $nama_file;
                // dd($berkas);
            }
        } else {
            $berkas = $barang->gambar;
        }
        try {
            DB::select('call editBarangjual(?,?,?,?,?,?,?)', array($idb, $request->nama, $request->harga, $request->stok, $request->kategori, $request->deskripsi, $berkas));

            return redirect()->route('datahewan.adopsi')->with('success', 'Data Barang berhasil dieditkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Gagal mengedit data Barang. Error: ' . $e->getMessage());
        }
    }


    public function kirimpenitipankasir(Request $request)
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
        DB::select('call tambahformpenitipankasir(?,?,?,?,?,?,?,?,?,?,?)', array($id_transaksi_baru, $request->get('ID_Pengguna'), $request->get('Nama_Pengguna'), $request->get('Peran'), $request->get('Nama_Hewan'), $request->get('Tanggal'), $request->get('Lama_Hari'), $request->get('Jenis_Layanan'), $request->get('Harga'), $berkas, $request->get('status')));
        session()->flash('success', 'Form pentipan berhasil ditambahkan ke penitipan.');
        return redirect()->back();
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

    public function list_faktur()
    {
        $faktur = DB::table('barangjual')
            ->join('transaksi', 'barangjual.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->select('transaksi.ID_Transaksi', 'barangjual.status', DB::raw('MAX(barangjual.Pengguna) as Pengguna'), DB::raw('SUM(barangjual.Harga_Satuan) as Harga_Satuan'))
            ->groupBy('transaksi.ID_Transaksi', 'barangjual.status')
            ->where('barangjual.status', '=', 'Selesai') // Tambahkan ini untuk filter status 'Selesai'
            ->get();
    
        return view("kasir.faktur.list-faktur", compact('faktur'));
    }
    


    public function detail_faktur($ID_Transaksi)
    {
        $detailFaktur = DB::table('barangjual')
            ->join('transaksi', 'barangjual.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->where('transaksi.ID_Transaksi', $ID_Transaksi)
            ->get();

        return view("kasir.faktur.detail-faktur", compact('detailFaktur'));
    }

    public function cetak_faktur($ID_Transaksi)
    {
        $detailFaktur = DB::table('barangjual')
            ->join('transaksi', 'barangjual.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->where('transaksi.ID_Transaksi', $ID_Transaksi)
            ->get();

        return view("kasir.faktur.cetak-faktur", compact('detailFaktur'));
    }

    public function print_faktur($ID_Transaksi)
    {
        $detailFaktur = DB::table('barangjual')
            ->join('transaksi', 'barangjual.ID_Transaksi', '=', 'transaksi.ID_Transaksi')
            ->where('transaksi.ID_Transaksi', $ID_Transaksi)
            ->get();

        return view("kasir.faktur.print-faktur", compact('detailFaktur'));
    }

    
    public function kirimDanUpdateKhususKasir(Request $request)
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
}
