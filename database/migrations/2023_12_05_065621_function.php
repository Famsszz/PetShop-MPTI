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
    DROP FUNCTION IF EXISTS total_harga_penitipan;
    CREATE FUNCTION total_harga_penitipan(penitipan_hargaa DECIMAL(10,2), harilamaa INT)
    RETURNS DECIMAL(10, 2)
    BEGIN
        DECLARE totalhargapenitipan DECIMAL(10,2);
        SET totalhargapenitipan = penitipan_hargaa * harilamaa;
        RETURN totalhargapenitipan;
    END;
    ');

    DB::unprepared('
    DROP FUNCTION IF EXISTS total_harga_satuan_barang;
    CREATE FUNCTION total_harga_satuan_barang(satuanhargaa DECIMAL(10,2), stokdipesann INT)
    RETURNS DECIMAL(10,2)
    BEGIN
        DECLARE totalhargasatuanbarang DECIMAL(10,2);
        SET totalhargasatuanbarang = satuanhargaa * stokdipesann;
        RETURN totalhargasatuanbarang;
    END;
    ');

    DB::unprepared('
    DROP FUNCTION IF EXISTS pecah_stok;
    CREATE FUNCTION pecah_stok(jumlahstokmasuk INT(11), pecah_stok_barang INT)
    RETURNS INT
    BEGIN
        DECLARE stok_barang INT;
        SET stok_barang = jumlahstokmasuk * pecah_stok_barang;
        RETURN stok_barang;
    END;
');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS total_harga_penitipan');
    }
};
