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

        CREATE TRIGGER after_barang_insert AFTER INSERT ON `barang` FOR EACH ROW
        BEGIN
            INSERT INTO log_barang (ID_Barang, Action, Nama_Barang_New, Harga_Satuan_New, Status_New, deskripsi_New, gambar_New, Diperbarui)
            VALUES (NEW.ID_Barang, "INSERT", NEW.Nama_Barang, NEW.Harga_Satuan, NEW.Status, NEW.deskripsi, NEW.gambar, CURRENT_TIMESTAMP);
        END
        
        ');

        DB::unprepared('

        CREATE TRIGGER after_barang_update AFTER UPDATE ON `barang` FOR EACH ROW
        BEGIN
            INSERT INTO log_barang (ID_Barang, Action, Nama_Barang_Old, Nama_Barang_New,
                                    Harga_Satuan_Old, Harga_Satuan_New, Status_Old, Status_New, deskripsi_Old, deskripsi_New,
                                    gambar_Old, gambar_New, Diperbarui)
            VALUES (OLD.ID_Barang, "UPDATE", OLD.Nama_Barang, NEW.Nama_Barang,
                    OLD.Harga_Satuan, NEW.Harga_Satuan, OLD.Status, NEW.Status, OLD.deskripsi, NEW.deskripsi,
                    OLD.gambar, NEW.gambar, CURRENT_TIMESTAMP);
        END

        ');

        DB::unprepared('
        CREATE TRIGGER after_barang_delete AFTER DELETE ON `barang` FOR EACH ROW
        BEGIN
            INSERT INTO log_barang (ID_Barang, Action, Nama_Barang_Old, Harga_Satuan_Old, Status_Old, deskripsi_Old, gambar_Old, Diperbarui)
            VALUES (OLD.ID_Barang, "DELETE", OLD.Nama_Barang, OLD.Harga_Satuan, OLD.Status, OLD.deskripsi, OLD.gambar, CURRENT_TIMESTAMP);
        END
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
