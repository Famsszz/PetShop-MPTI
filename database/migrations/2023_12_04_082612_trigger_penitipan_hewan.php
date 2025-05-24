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
       
        CREATE TRIGGER after_Penitipan_hewan_insert AFTER INSERT ON `penitipan_hewan` FOR EACH ROW
        BEGIN
            INSERT INTO log_penitipan_hewan(ID_Penitipan,ID_Pengguna, Action, Nama_Hewan_New, Lama_Hari_New, Jenis_Layanan_New, Harga_New, Diperbarui)
            VALUES (NEW.ID_Penitipan, NEW.ID_Pengguna, "INSERT", NEW.Nama_Hewan, NEW.Lama_Hari, NEW.Jenis_Layanan, NEW.Harga, CURRENT_TIMESTAMP);
        END

        ');

        DB::unprepared('
        CREATE TRIGGER after_Penitipan_hewan_update AFTER UPDATE ON `penitipan_hewan` FOR EACH ROW
        BEGIN
            INSERT INTO log_penitipan_hewan(ID_Penitipan, ID_Pengguna, Action, Nama_Hewan_Old, Nama_Hewan_New, Lama_Hari_Old, Lama_Hari_New, Jenis_Layanan_Old, 
                Jenis_Layanan_New, Harga_Old, Harga_New, Diperbarui)
            VALUES (OLD.ID_Penitipan, OLD.ID_Pengguna, "UPDATE", OLD.Nama_Hewan, NEW.Nama_Hewan, OLD.Lama_Hari, NEW.Lama_Hari, 
                OLD.Jenis_Layanan, NEW.Jenis_Layanan, OLD.Harga, NEW.Harga, CURRENT_TIMESTAMP);
        END
        ');
    

        DB::unprepared('
        CREATE TRIGGER after_Penitipan_Hewan_delete AFTER DELETE ON `penitipan_hewan` FOR EACH ROW
        BEGIN
            INSERT INTO log_penitipan_hewan (ID_Penitipan, ID_Pengguna, Action, Nama_Hewan_Old, Lama_Hari_Old, Jenis_Layanan_Old, Harga_Old, Diperbarui)
            VALUES (OLD.ID_Penitipan, OLD.ID_Pengguna, "DELETE", OLD.Nama_Hewan, OLD.Lama_Hari, OLD.Jenis_Layanan, OLD.Harga, CURRENT_TIMESTAMP);
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
