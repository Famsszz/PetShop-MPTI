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
       DROP USER IF EXISTS "Pelanggan"@"localhost";
            CREATE USER "Pelanggan"@"localhost" IDENTIFIED BY "passwordPelanggan";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.barang TO "Pelanggan"@"localhost";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.kategori TO "Pelanggan"@"localhost";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.penitipan_hewan TO "Pelanggan"@"localhost";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.keranjang TO "Pelanggan"@"localhost";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.transaksi TO "Pelanggan"@"localhost";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.barangjual TO "Pelanggan"@"localhost";
            GRANT SELECT ON petshop_new.* TO "Pelanggan"@"localhost";
            GRANT EXECUTE ON petshop_new.* TO "Pelanggan"@"localhost";
            FLUSH PRIVILEGES;
       ');

       DB::unprepared('
       DROP USER IF EXISTS "Kasir"@"localhost";
            CREATE USER "Kasir"@"localhost" IDENTIFIED BY "passwordKasir";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.barang TO "Kasir"@"localhost";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.kategori TO "Kasir"@"localhost";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.penitipan_hewan TO "Kasir"@"localhost";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.keranjang TO "Kasir"@"localhost";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.transaksi TO "Kasir"@"localhost";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.barangjual TO "Kasir"@"localhost";
            GRANT SELECT, INSERT, UPDATE, DELETE ON petshop_new.stok_masuk TO "Kasir"@"localhost";
            GRANT EXECUTE ON petshop_new.* TO "Kasir"@"localhost";
            GRANT SELECT ON petshop_new.* TO "Kasir"@"localhost";
            FLUSH PRIVILEGES;
       ');
       
       DB::unprepared('
       DROP USER IF EXISTS "Admin"@"localhost";
            CREATE USER "Admin"@"localhost" IDENTIFIED BY "passwordAdmin";
            GRANT ALL PRIVILEGES ON petshop_new.* TO "Admin"@"localhost";
            FLUSH PRIVILEGES;
       ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
