<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return 
     */
    public function up()
    {

        DB::unprepared('
        DROP VIEW IF EXISTS view_barang_masuk;
        CREATE VIEW view_barang_masuk AS SELECT 
        a.ID_StokMasuk, a.ID_Barang, b.Nama_Barang, a.Stok_Masuk, b.gambar
        FROM stok_masuk a
        JOIN barang b ON
        a.ID_Barang = b.ID_Barang;
        ');

        DB::unprepared('
        DROP VIEW IF EXISTS view_detail_penitipan;
        CREATE VIEW view_detail_penitipan AS SELECT 
        a.ID_Penitipan, b.Nama_Pengguna, a.Nama_Hewan, a.Lama_Hari, a.Jenis_Layanan, a.Harga
        FROM penitipan_hewan a
        JOIN users b ON
        a.ID_Pengguna = b.ID_Pengguna;

        ');

        DB::unprepared('
        DROP VIEW IF EXISTS view_pencatatan_barang_masuk;
        CREATE VIEW view_pencatatan_barang_masuk AS SELECT 
        a.ID_StokMasuk, b.Nama_Barang, b.Harga_Satuan, a.Stok_Masuk
        FROM stok_masuk a
        JOIN barang b ON
        a.ID_Barang = b.ID_Barang;
        ');

        DB::unprepared('
        DROP VIEW IF EXISTS view_log_barang;
        CREATE VIEW view_log_barang AS SELECT 
        ID_Barang, Action AS Aksi,
        Nama_Barang_Old AS Nama_Barang_SblmAksi, 
        Nama_Barang_New AS Nama_SsdhAksi, 
        Harga_Satuan_Old AS HargaSblmnya, 
        Harga_Satuan_New AS HargaSsdhnya, 
        Status_Old AS Status_SblmAksi, 
        Status_New AS Status_SsdhAksi, 
        Diperbarui AS TglAksi
        FROM log_barang;
        ');

        DB::unprepared('
        DROP VIEW IF EXISTS view_log_penitipan_hewan;
        CREATE VIEW view_log_penitipan_hewan AS SELECT 
        a.ID_Penitipan, b.Nama_Pengguna, a.Action,
        Nama_Hewan_Old AS Nama_Hewan_SblmAksi,
        Nama_Hewan_New AS Nama_Hewan_SsdhAksi,
        Lama_Hari_Old AS Lama_Hari_SblmAksi,
        Lama_Hari_New AS Lama_Hari_SsdhAksi,
        Jenis_Layanan_Old AS Jenis_Layanan_SblmAksi,
        Jenis_Layanan_New AS Jenis_Layanan_SsdhAksi,
        Harga_Old AS Harga_SblmAksi,
        Harga_New AS Harga_SsdhAksi,
        Diperbarui AS Tgl_Aksi
        FROM log_penitipan_hewan a 
        JOIN users b ON
        a.ID_Pengguna = b.ID_Pengguna;
        ');

        DB::unprepared('
        DROP VIEW IF EXISTS view_log_stok;
        CREATE VIEW view_log_stok AS SELECT
        b.Nama_Barang, 
        a.Stok_jual_Old AS Stok_jual_SblmAksi, 
        a.Stok_jual_New AS Stok_jual_SsdhAksi,
        a.Diperbarui AS Tgl_Aksi  
        FROM log_stok a
        JOIN barang b ON
        a.ID_Barang = b.ID_Barang;
        ');

        DB::unprepared('
        DROP VIEW IF EXISTS view_log_stok_masuk;
        CREATE VIEW view_log_stok_masuk AS SELECT
        a.ID_StokMasuk, c.Nama_Barang, 
        a.Stok_Masuk_Old AS Stok_Masuk_SblmAksi,
        a.Stok_Masuk_New AS Stok_Masuk_SsdhAksi,
        a.Diperbarui AS Tgl_Aksi
        FROM log_stok_masuk a	
        JOIN barang c ON
        a.ID_Barang = c.ID_Barang;
        ');

        DB::unprepared('
        DROP VIEW IF EXISTS view_log_pengguna;
        CREATE VIEW view_log_pengguna AS SELECT
        ID_Pengguna AS ID_Pengguna,
        Action AS Aksi,
        Nama_Akun_Old AS Nama_Akun_SblmAksi,
        Nama_Akun_New AS Nama_Akun_SsdhAksi,
        Nama_Pengguna_Old AS Nama_Pengguna_SblmAksi,
        Nama_Pengguna_New AS Nama_Pengguna_SsdhAksi,
        No_Telp_Old AS No_Telp_SblmAksi,
        No_Telp_New AS No_Telp_SsdhAksi,
        Email_Old AS Email_SblmAksi,
        Email_New AS Email_SsdhAksi,
        Peran_Old AS Peran_SblmAksi,
        Peran_New AS Peran_SsdhAksi,
        Diperbarui AS Tgl_Aksi
        FROM log_pengguna;
        ');

        DB::unprepared('
        DROP VIEW IF EXISTS view_detail_HewanAdopsi;
        CREATE VIEW view_detail_HewanAdopsi AS SELECT 
        a.ID_Barang,
        a.Nama_Barang AS Nama_Hewan,
        a.Harga_Satuan,  
        a.Status,
        a.Stok_Jual,
        b.Nama_Kategori,
        a.deskripsi,
        a.gambar
        FROM barang a
        JOIN kategori b ON 
        a.ID_Kategori = b.ID_Kategori
        WHERE a.status = "adopsi";
        ');

        DB::unprepared('
        DROP VIEW IF EXISTS view_detail_barang;
        CREATE VIEW view_detail_barang AS SELECT 
        a.ID_Barang,
        a.Nama_Barang,
        a.Harga_Satuan,  
        a.Status,
        a.Stok_Jual,
        a.gambar,
        b.Nama_Kategori,
        a.deskripsi
        FROM barang a
        JOIN kategori b ON 
        a.ID_Kategori = b.ID_Kategori
        WHERE a.status = "jual";
        ');
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS view_barang_masuk');
        DB::unprepared('DROP VIEW IF EXISTS view_detail_penitipan');
        DB::unprepared('DROP VIEW IF EXISTS view_pencatatan_barang_masuk');
        DB::unprepared('DROP VIEW IF EXISTS view_log_barang');
        DB::unprepared('DROP VIEW IF EXISTS view_log_keranjang');
        DB::unprepared('DROP VIEW IF EXISTS view_log_penitipan_hewan');
        DB::unprepared('DROP VIEW IF EXISTS view_view_log_stok');
        DB::unprepared('DROP VIEW IF EXISTS view_log_stok_masuk');
        DB::unprepared('DROP VIEW IF EXISTS view_log_pengguna');
        DB::unprepared('DROP VIEW IF EXISTS view_detail_HewanAdopsi');
        DB::unprepared('DROP VIEW IF EXISTS view_detail_barang');

    }
};