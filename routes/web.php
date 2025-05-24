<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgoPassController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Models\Admin;
use App\Models\Detail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/Home', [HomeController::class, 'index'])->middleware('auth');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
*/

Route::get('/', [Controller::class, 'index'])->middleware('guest');

Route::view('/welcome', 'welcome');

//login & regis
// Route::get('/regUser', [RegisterController::class, 'index']);
// Route::post('/regUser', [Registercontroller::class, 'store']);

// Route::get('/logUser', [LoginController::class, 'index'])->name('login');
// Route::post('/logUser', [LoginController::class, 'authenticate'])->name('login_masuk');

// Route::get('/forget', [ForgoPassController::class, 'forgotPass'])->name('forgot');
// Route::post('/forget', [ForgoPassController::class, 'update'])->name('forgot.update');

// Route::get('/resetPass/{token}', [ResetPasswordController::class, 'index'])->name('resetPass')->middleware('verify.token');
// Route::post('/resetPass', [ResetPasswordController::class, 'update']);

// Route::get('/send_email', [ForgoPassController::class, 'index']);  
  
Route::get('/detail-barang/{item:ID_Barang}', [DetailController::class, 'detailbarang']);
Route::get('/detail-hewan/{item:ID_Barang}', [DetailController::class, 'detailhewan']); 

Route::group(['middleware' => ['Pelanggan']], function () {
    Route::get('/makanan', [Pagecontroller::class, 'makanan']);
    Route::get('/alat', [Pagecontroller::class, 'alat']);
    Route::get('/adopsi', [Pagecontroller::class, 'adopsi']);
    Route::get('/keranjang', [PageController::class, 'keranjang']);
    Route::post('/keranjang', [PageController::class, 'kirimDanUpdate']);
    Route::delete('/keranjang/{krjg:ID_Keranjang}', [PageController::class, 'deletekeranjang'])->name('hapus.keranjang');
    Route::get('pengambilan-page', [PageController::class, 'pengambilanbarang']);
    Route::get('/penitipan', [PageController::class, 'penitipan']);
    Route::post('/penitipan', [PageController::class, 'kirimpenitipan']);
    Route::get('penitipan-page', [PageController::class, 'penitipanpage']);
    Route::delete('/penitipan/{pntpn:ID_Penitipan}', [PageController::class, 'deletepenitipan']);
    Route::post('/keranjang/terima-semua', [PageController::class, 'terimasemuakeranjang']);
});


//admin
Route::group(['middleware' => ["admin"]], function () {
    Route::get('/admindashboard', [AdminController::class, 'dashboardadmin']);
    Route::get('/datapengguna', [AdminController::class, 'datapengguna'])->name('data_pengguna');
    Route::delete('/datapengguna/{datapelanggan:ID_Pengguna}', [AdminController::class, 'deletedatapengguna']);
    Route::get('/search-pelanggan', [AdminController::class, 'searchpelanggan'])->name('pelanggan.search');
    Route::get('/datastok', [AdminController::class, 'datastok']);
    Route::get('/search-stok-admin', [AdminController::class, 'searchstokadmin'])->name('stokadmin.search');
    Route::get('/datapesanan', [AdminController::class, 'datapesanan']);
    Route::get('/admindatabarang', [AdminController::class, 'admindatabarang']);
    Route::get('/search-barang-admin', [AdminController::class, 'searchbarang'])->name('barangadmin.search');
    Route::get('/admindatahewanadopsi', [AdminController::class, 'admindataadopsi']);
    Route::get('/datakasir', [AdminController::class, 'datakasir'])->name('data_kasir');
    Route::get('/datalogpengguna', [AdminController::class, 'log_pengguna']);
    Route::get('/datalogbarang', [AdminController::class, 'log_barang']);
    Route::get('/datalogpenhewan', [AdminController::class, 'log_penitipan_hewan']);
    Route::get('/datalogtransaksi', [AdminController::class, 'log_transaksi']);
    Route::get('/datalogbook', [AdminController::class, 'log_book']);
    Route::get('/datalogjual', [AdminController::class, 'log_jual']);
    Route::get('/datalogmasuk', [AdminController::class, 'log_masuk']);
    Route::get('/tambahkasir', [AdminController::class, 'tambahkasir']);
    Route::post('/tambahkasirkedatabase', [AdminController::class, 'tambahkasirkedatabase']);
    Route::get('/editkasir/{idp}', [AdminController::class, 'editkasir']);
    Route::delete('/datakasir/{ID_Pengguna}', [AdminController::class, 'hapuskasir'])->name('datakasir.hapus');
    Route::put('/editkasirdb/{idp}', [AdminController::class, 'editkasirdb'])->name('edit.kasirdb');
    Route::get('barangterjual', [AdminController::class, 'barangterjual']);
    Route::get('riwayatpenitipan', [AdminController::class, 'riwayatpenitipan']);
    Route::delete('/deletehistorybarang/{tjwl:ID_barangjual}', [AdminController::class, 'hapusbarangterjual']);
    Route::delete('/deletehistorypenitipan/{pntpn:ID_Penitipan}', [AdminController::class, 'hapuspenitipan']);
});


//kasir
Route::group(['middleware' => ["kasir"]], function () {
    Route::get('/kasirdashboard', [KasirController::class, 'dashboardkasir']);
    Route::get('/datastokkasir', [KasirController::class, 'datastokkasir'])->name('data.stok.masuk');
    Route::get('/datapesanankasir', [KasirController::class, 'datapesanankasir']);
    Route::post('/datapesanankasir/terima/{krjg:ID_barangjual}', [KasirController::class, 'statusterima']);
    Route::post('/datapesanankasir/tolakbarangjual/{krjg:ID_barangjual}', [KasirController::class, 'statustolakbarangjual']);
    Route::post('/datapesanankasir/tolak/{krjg:ID_Keranjang}', [KasirController::class, 'statustolak']);
    Route::get('/datapenitipankasir', [KasirController::class, 'datapenitipankasir']);
    Route::post('/datapenitipankasir/terima', [KasirController::class, 'statusterimapenitipan']);
    Route::post('/datapenitipankasir/tolak/{pntpn:ID_Penitipan}', [KasirController::class, 'statustolakpenitipan']);
    Route::get('pengambilan-kasir', [KasirController::class, 'pengambilanbarang']);
    Route::get('penitipan-kasir', [KasirController::class, 'pesananpenitipan']);
    Route::post('/penitipan-kasir', [KasirController::class, 'kirimpenitipankasir']);
    Route::post('pengambilan/{krjg:ID_barangjual}', [KasirController::class, 'pengambilanselesai']);
    Route::post('penitipan/{p:ID_Penitipan}', [KasirController::class, 'penitipanselesai']);
    Route::get('/databarang', [KasirController::class, 'databarang'])->name('data.barang')->middleware('auth');
    Route::get('/search-barang', [KasirController::class, 'search'])->name('barang.search');
    Route::get('/tambahbarang', [KasirController::class, 'tambahbarang'])->middleware('auth');
    Route::get('/tambahstokmasuk', [KasirController::class, 'tambahstokmasuk'])->middleware('auth');
    Route::get('/tambahpenitipan', [KasirController::class, 'tambahpenitipan']);
    Route::get('barangjual', [KasirController::class, 'barangjual']);
    Route::post('barangjual', [KasirController::class, 'kirimbarangjual']);
    Route::get('/search-stok', [KasirController::class, 'caristok'])->name('stok.search');
    Route::post('/tambahstokdb', [KasirController::class, 'tambahstokmasukdatabase']);
    Route::get('/tambahstokmasuk', [KasirController::class, 'tambahstokmasuk'])->middleware('auth');
    Route::post('/tambahbarangdatabase', [KasirController::class, 'tambahbarangdatabase']);
    Route::get('/datahewanadopsi', [KasirController::class, 'datahewanadopsi'])->name('datahewan.adopsi')->middleware('auth');
    Route::get('/tambahhewanadopsi', [KasirController::class, 'tambahhewanadopsi'])->middleware('auth');
    Route::post('/tambahhewandatabase', [KasirController::class, 'tambahhewandatabase']);
    Route::delete('/databarang/{ID_Barang}', [KasirController::class, 'hapus'])->name('databarang.hapus');
    Route::delete('/datahewanadopsi/{ID_Barang}', [KasirController::class, 'hapushewanadopsi'])->name('datahewanadopsi.hapushewanadopsi');
    Route::delete('/datastokkasir/{ID_StokMasuk}', [KasirController::class, 'hapusstokmasuk'])->name('datastokkasir.hapusstokmasuk');
    Route::get('/editbarang/{idb}', [KasirController::class, 'editbarang']);
    Route::put('/editbarangdatabase/{idb}', [KasirController::class, 'editbarangdatabase'])->name('edit.barang');
    Route::get('/edithewanadopsi/{idb}', [KasirController::class, 'edithewanadopsi']);
    Route::put('/edithewanadopsidb/{idb}/', [KasirController::class, 'edithewanadopsidb'])->name('hewanadopsi.edithewan');
    Route::get('/list-faktur', [KasirController::class, 'list_faktur']);
    Route::get('/detail-faktur/{ID_Transaksi}', [KasirController::class, 'detail_faktur']);
    Route::get('/cetak-faktur/{ID_Transaksi}', [KasirController::class, 'cetak_faktur']);
    Route::get('/print-faktur{ID_Transaksi}', [KasirController::class, 'print_faktur']);
    Route::get('/tambahstokmasukpecah', [KasirController::class, 'tambahstokmasukpecah'])->middleware('auth');
    Route::post('/tambahstokpecahdb', [KasirController::class, 'tambahStokmasukpecahdb']);
    Route::get('/detailkeranjang/{krjg:ID_Transaksi}', [KasirController::class, 'detailkeranjang']);
    Route::post('/datapesanankasir/terima-semua', [KasirController::class, 'terimasemua']);
    Route::post('/datapesanankasir/terima-semua2', [KasirController::class, 'terimasemua2']);
    Route::get('detailpenitipan/{pntpn:Nama_Pengguna}', [KasirController::class, 'detailpenitipan']);
    Route::post('/keranjangKhususkasir', [KasirController::class, 'kirimDanUpdateKhususKasir']);
    // Route::post('/datapesananpenitipan/terima-semua', [KasirController::class, 'terimasemuapentipan']);
});

//Keranjang
Route::get('/keranjangpenitipan', [DetailController::class, 'keranjangpenitipan']);
Route::get('/formpenitipan', [DetailController::class, 'formpenitipan'])->middleware('auth');
Route::get('/statusKeranjang', [DetailController::class, 'statusKeranjang'])->middleware('auth');

require __DIR__ . '/auth.php';
