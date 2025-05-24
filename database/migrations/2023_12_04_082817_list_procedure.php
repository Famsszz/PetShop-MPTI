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
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        DROP PROCEDURE IF EXISTS tambahBarangJual;
        CREATE PROCEDURE tambahBarangJual (naBar VARCHAR(255), hargasatu DECIMAL(10,2), stokk INT (11), idkategori int(10), desk VARCHAR(255), gbr VARCHAR(255) )
        BEGIN
        INSERT INTO barang(Nama_Barang, Harga_Satuan, Status, Stok_Jual, ID_Kategori, deskripsi, gambar) VALUES (naBar, hargasatu, "jual", stokk, idkategori, desk, gbr);
        END
        ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS editBarangJual;
        CREATE PROCEDURE editBarangJual (idb int(20), naBar VARCHAR(255), hargasatu DECIMAL(10,2), stokk INT (11), idkategori int(10), desk VARCHAR(255), gbr VARCHAR(255) )
        BEGIN
        UPDATE barang
        SET
            Nama_Barang = naBar,
            Harga_Satuan = hargasatu,
            Stok_Jual = stokk,
            ID_Kategori = idkategori,
            deskripsi = desk,
            gambar = gbr
            WHERE ID_Barang = idb;
            END
        ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS tambahKasir;
        CREATE PROCEDURE tambahKasir (nakun VARCHAR(255), napeng VARCHAR(255), kasan VARCHAR(255), nohp VARCHAR(255),  emaill VARCHAR(255) )
        BEGIN
        INSERT INTO users(Nama_Akun, Nama_Pengguna, password, No_Telp, email, Peran) VALUES (nakun, napeng, kasan, nohp, emaill, "Kasir");
        END 
        ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS editKasir;
        CREATE PROCEDURE editKasir (idp int(20), nakun VARCHAR(255), napeng VARCHAR(255), nohp VARCHAR(255),  emaill VARCHAR(255) )
        BEGIN
        UPDATE users
        SET
            Nama_Akun = nakun,
            Nama_Pengguna = napeng,
            No_Telp = nohp,
            email = emaill
            WHERE ID_Pengguna = idp;
        END 
        ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS tambahHewanAdopsi;
        CREATE PROCEDURE tambahHewanAdopsi (naBar VARCHAR(255), hargasatu DECIMAL(10,2), stokk INT (11), idkategori int(10), desk VARCHAR(255), gbr VARCHAR(255) )
        BEGIN
        INSERT INTO barang(Nama_Barang, Harga_Satuan, Status, Stok_Jual, ID_Kategori, deskripsi, gambar) VALUES (naBar, hargasatu, "adopsi", stokk, idkategori, desk, gbr);
        END
        ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS tambahStokMasuk;
        CREATE PROCEDURE tambahStokMasuk (idbar int(20), stokmasuk int(11) )
        BEGIN
        INSERT INTO stok_masuk(ID_Barang, Stok_Masuk, created_at) VALUES (idbar, stokmasuk, NOW());
        END
        ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS tambahkeranjangbarangdantransaksi;
        CREATE PROCEDURE tambahkeranjangbarangdantransaksi (transaksiid int, barangid int, penggunaid int, kategoriid int, nabar varchar(255), napengguna varchar(255), Perann ENUM("Admin", "Pelanggan", "Kasir"), nakategori varchar(255), satuanharga decimal(10,2), desk varchar(255), stokdipesan int, foto varchar(255), statuss ENUM("Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
        BEGIN
        INSERT INTO barangjual(ID_Transaksi, ID_Barang, ID_Pengguna, ID_Kategori, Barang, Pengguna, Peran, Nama_Kategori, Harga_Satuan, deskripsi, jumlah_stok_dipesan, gambar, status)
        VALUES (transaksiid, barangid, penggunaid, kategoriid, nabar, napengguna, Perann, nakategori, satuanharga, desk, stokdipesan, foto, statuss);
        END;
        ');


        DB::unprepared('
        DROP PROCEDURE IF EXISTS tambahkeranjangbarang;
        CREATE PROCEDURE tambahkeranjangbarang (transaksid int, barangid int, penggunaid int, kategoriid int, nabar varchar(255), napengguna varchar(255), Perann ENUM("Admin", "Pelanggan", "Kasir"), nakategori varchar(255), satuanharga decimal(10,2), desk varchar(255), stokdipesan int, foto varchar(255), statuss ENUM("Keranjang", "Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
        BEGIN
        INSERT INTO keranjang(ID_Transaksi, ID_Barang, ID_Pengguna, ID_Kategori, Barang, Pengguna, Peran, Nama_Kategori, Harga_Satuan, deskripsi, jumlah_stok_dipesan, gambar, status)
        VALUES (transaksid, barangid, penggunaid, kategoriid, nabar, napengguna, Perann, nakategori, satuanharga, desk, stokdipesan, foto, statuss);
        END;
        ');
        

        DB::unprepared('
        DROP PROCEDURE IF EXISTS terimasemuakeranjang;
        CREATE PROCEDURE terimasemuakeranjang (penggunaid int, statuss ENUM("Keranjang", "Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
        BEGIN
        UPDATE keranjang
        SET status = statuss
        WHERE ID_Pengguna = penggunaid AND status = "Keranjang";
        END
        ');
        // mengupdate keranjang yang statusnya keranjang, artinya jika diklik beli sebua di keranjang yang diupdate cuman yang status keranjang

        DB::unprepared('
        DROP PROCEDURE IF EXISTS terimasemuakeranjangoffline;
        CREATE PROCEDURE terimasemuakeranjangoffline (penggunaid int, statuss ENUM("Keranjang", "Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
        BEGIN
        UPDATE keranjang
        SET status = statuss
        WHERE ID_Pengguna = penggunaid;
        END
        '); 


        DB::unprepared('
        DROP PROCEDURE IF EXISTS terimasemuakeranjangbarangjual;
        CREATE PROCEDURE terimasemuakeranjangbarangjual (penggunaid int, statuss ENUM("Keranjang", "Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
        BEGIN
        UPDATE barangjual
        SET status = statuss
        WHERE ID_Pengguna = penggunaid;
        END
        ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS tambahformpenitipan;
        CREATE PROCEDURE tambahformpenitipan (trskid int, penggunaid int, napengguna varchar(255), Perann ENUM("Admin", "Pelanggan", "Kasir"), nahewan varchar(255), tgl date, harilama int, layananjenis enum("penitipan", "grooming", "penitipan_dan_grooming"), satuanharga decimal(10,2), foto varchar(255))
        BEGIN
        DECLARE penitipan_harga decimal (10,2);
        DECLARE total_penitipan decimal(10,2);

        IF layananjenis = "penitipan" then
            set penitipan_harga = 50000;
        elseif layananjenis = "grooming" then
            set penitipan_harga = 10000;
        elseif layananjenis = "penitipan_dan_grooming" then
            set penitipan_harga = 150000;
        END IF;

        SET total_penitipan = total_harga_penitipan(penitipan_harga, harilama);

        INSERT INTO penitipan_hewan(ID_Transaksi, ID_Pengguna, Nama_Pengguna, Peran, Nama_Hewan, Tanggal, Lama_Hari, Jenis_Layanan, Harga, gambar)
        VALUES(trskid, penggunaid, napengguna, Perann, nahewan, tgl, harilama, layananjenis, total_penitipan, foto);
        END;
        ');


        DB::unprepared('
        DROP PROCEDURE IF EXISTS tambahformpenitipankasir;
        CREATE PROCEDURE tambahformpenitipankasir (trskid int, penggunaid int, napengguna varchar(255), Perann ENUM("Admin", "Pelanggan", "Kasir"), nahewan varchar(255), tgl date, harilama int, layananjenis enum("penitipan", "grooming", "penitipan_dan_grooming"), satuanharga decimal(10,2), foto varchar(255), statuss ENUM("Keranjang", "Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
        BEGIN
        DECLARE penitipan_harga decimal (10,2);
        DECLARE total_penitipan decimal(10,2);

        IF layananjenis = "penitipan" then
            set penitipan_harga = 50000;
        elseif layananjenis = "grooming" then
            set penitipan_harga = 10000;
        elseif layananjenis = "penitipan_dan_grooming" then
            set penitipan_harga = 150000;
        END IF;

        SET total_penitipan = total_harga_penitipan(penitipan_harga, harilama);

        INSERT INTO penitipan_hewan(ID_Transaksi, ID_Pengguna, Nama_Pengguna, Peran, Nama_Hewan, Tanggal, Lama_Hari, Jenis_Layanan, Harga, gambar, status)
        VALUES(trskid, penggunaid, napengguna, Perann, nahewan, tgl, harilama, layananjenis, total_penitipan, foto, statuss);
        END;
        ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS perbaruistok;
        CREATE PROCEDURE perbaruistok (barangid int, quantity int)
        BEGIN
        DECLARE stokkurang int;
        DECLARE stokk int;
        SELECT Stok_Jual INTO stokk FROM barang WHERE ID_Barang = barangid;
        SET stokkurang = stokk - quantity;
        UPDATE barang
        SET Stok_Jual = stokkurang
        WHERE ID_Barang = barangid;
        END;
        '); 
        // updtae stok yang dibeli user

        DB::unprepared('
        DROP PROCEDURE IF EXISTS stokjualbalikkasir;
        CREATE PROCEDURE stokjualbalikkasir (barangid int, quantity int)
        BEGIN
        UPDATE barang
        SET Stok_Jual = quantity
        WHERE ID_Barang = barangid;
        END;
        ');
        // update stok yang dibeli kasir offline

        DB::unprepared('
        DROP PROCEDURE IF EXISTS updatestatus;
        CREATE PROCEDURE updatestatus (barangjualid INT, statuss ENUM("Keranjang", "Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
        BEGIN
        UPDATE barangjual
        SET status = statuss
        WHERE ID_barangjual = barangjualid;

        UPDATE keranjang
        SET status = statuss
        WHERE ID_Keranjang = barangjualid;
        END
        '); 
        // procedure di atas buat ngupdate status barang dan keranjang yang mana barang ini telah dibayar atau barang dibatalkan. mengubah status menjadi berhasil atau gagal

        DB::unprepared('
        DROP PROCEDURE IF EXISTS updatestatuskeranjang;
        CREATE PROCEDURE updatestatuskeranjang (keranjangid INT, statuss ENUM("Keranjang", "Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
        BEGIN
        UPDATE keranjang
        SET status = statuss
        WHERE ID_Keranjang = keranjangid;
        END
        '); 
        // procedure di atas buat ngupdate status keranjang yang mana barang ini telah dibayar atau barang dibatalkan. mengubah status menjadi berhasil atau gagal

        DB::unprepared('
        DROP PROCEDURE IF EXISTS updatestatusselesaibarang;
        CREATE PROCEDURE updatestatusselesaibarang (barangjualid INT, statuss ENUM("Keranjang", "Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
        BEGIN
        UPDATE barangjual
        SET status = statuss
        WHERE ID_barangjual = barangjualid;
        END
        ');
        // procedure di atas buat ngupdate status menjadi selesai, yang berguna untuk memastikan apakah pengguna sudah mengambil barang yang telah dipesannya atau belum



        DB::unprepared('
        DROP PROCEDURE IF EXISTS updatestatusselesaipenitipan;
        CREATE PROCEDURE updatestatusselesaipenitipan (penitipanid INT, statuss ENUM("Keranjang", "Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
        BEGIN
        UPDATE penitipan_hewan
        SET status = statuss
        WHERE ID_Penitipan = penitipanid;
        END
        ');
        // procedure di atas buat ngupdate status menjadi selesai, yang berguna untuk memastikan apakah pengguna sudah mengambil penitipan yang telah dititipnya atau belum

        
    //     DB::unprepared('
    //     DROP PROCEDURE IF EXISTS updatestatusterimasemua;
    //     CREATE PROCEDURE updatestatusterimasemua (statuss ENUM("Keranjang", "Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
    //     BEGIN
    //         UPDATE barangjual
    //         SET status = statuss
    //         WHERE status IN ("Menunggu_Pembayaran", "Offline");
    //     END
    // ');
    // procedure di atas berguna untuk mengubah semua status yang Offline menjadi selesai

        DB::unprepared('
        DROP PROCEDURE IF EXISTS updatestatusidtransaksiterimasemua;
        CREATE PROCEDURE updatestatusidtransaksiterimasemua (transaksiid INT, statuss ENUM("Keranjang", "Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
        BEGIN
        UPDATE barangjual
        SET status = statuss
        WHERE ID_Transaksi = transaksiid;

        UPDATE keranjang
        SET status = statuss
        WHERE ID_Transaksi = transaksiid;
        END
        ');
        // procedure di atas berguna untuk mengubah status semua data menjadi berhasil di keranjang dan barangjual berdasarkan ID_Transaksi


    //     DB::unprepared('
    //     DROP PROCEDURE IF EXISTS updatestatuspenitipanterimasemua;
    //     CREATE PROCEDURE updatestatuspenitipanterimasemua (statuss ENUM("Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
    //     BEGIN
    //         UPDATE penitipan_hewan
    //         SET status = "Selesai"
    //         WHERE status IN ("Menunggu_Pembayaran", "Offline");
    //     END
    // ');
    //  !!!! gajadi makai procedure ini
    

        DB::unprepared('
        DROP PROCEDURE IF EXISTS updatestatuspenitipan;
        CREATE PROCEDURE updatestatuspenitipan (penitipanid INT, statuss ENUM("Keranjang", "Menunggu_Pembayaran", "Berhasil", "Gagal", "Offline", "Selesai"))
        BEGIN
        UPDATE penitipan_hewan
        SET status = statuss
        WHERE ID_Penitipan = penitipanid;
        END
        ');
        // procedure di atas buat ngupdate status penitipan yang mana penitipan ini telah dibayar atau penitipan dibatalkan. mengubah status menjadi berhasil atau gagal
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE tambahBarangJual");
        DB::unprepared("DROP PROCEDURE tambahKasir");
        DB::unprepared("DROP PROCEDURE tambahHewanAdopsi");
        DB::unprepared("DROP PROCEDURE tambahStokMasuk");
        DB::unprepared("DROP PROCEDURE tambahkeranjangbarang");
        DB::unprepared("DROP PROCEDURE tambahformpenitipan");
    }
};
