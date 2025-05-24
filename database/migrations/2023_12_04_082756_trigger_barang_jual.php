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
        CREATE TRIGGER after_barangjual_insert AFTER INSERT ON `barangjual` FOR EACH ROW
        BEGIN
            INSERT INTO log_barangjual (ID_barangjual, ID_Transaksi, Barang, Pengguna, action, Harga_Satuan_New, jumlah_stok_dipesan_New, created_at, updated_at)
            VALUES (NEW.ID_barangjual, NEW.ID_Transaksi, NEW.Barang, NEW.Pengguna, "INSERT", NEW.Harga_Satuan, NEW.jumlah_stok_dipesan, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
        END;
        

        ');

        DB::unprepared('
        CREATE TRIGGER after_barangjual_update AFTER UPDATE ON `barangjual` FOR EACH ROW
        BEGIN
            INSERT INTO log_barangjual (ID_barangjual, ID_Transaksi, Barang, Pengguna, action, Harga_Satuan_Old, Harga_Satuan_New, jumlah_stok_dipesan_Old, jumlah_stok_dipesan_New, created_at, updated_at)
            VALUES (OLD.ID_barangjual, OLD.ID_Transaksi, OLD.Barang, OLD.Pengguna, "UPDATE", OLD.Harga_Satuan, NEW.Harga_Satuan, OLD.jumlah_stok_dipesan, NEW.jumlah_stok_dipesan, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
        END;
        

        ');

            DB::unprepared('
            CREATE TRIGGER after_barangjual_delete AFTER DELETE ON `barangjual` FOR EACH ROW
            BEGIN
                INSERT INTO log_barangjual (ID_barangjual, ID_Transaksi, Barang, Pengguna, action, Harga_Satuan_Old, jumlah_stok_dipesan_Old, created_at, updated_at)
                VALUES (OLD.ID_barangjual, OLD.ID_Transaksi, OLD.Barang, OLD.Pengguna, "DELETE", OLD.Harga_Satuan, OLD.jumlah_stok_dipesan, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
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
        //
    }
};
