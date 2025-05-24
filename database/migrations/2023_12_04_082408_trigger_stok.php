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
        
        CREATE TRIGGER after_stok_masuk_insert
        AFTER INSERT ON stok_masuk
        FOR EACH ROW
        BEGIN
            UPDATE barang
            SET Stok_Jual = Stok_Jual + NEW.Stok_Masuk
            WHERE ID_Barang = NEW.ID_Barang;

            INSERT INTO log_stok_masuk (ID_StokMasuk, ID_Barang, Stok_Masuk_New)
            VALUES (NEW.ID_StokMasuk, NEW.ID_Barang, NEW.Stok_Masuk);
        END

        ');

        DB::unprepared('
        CREATE TRIGGER after_stok_update
        AFTER UPDATE ON barang
        FOR EACH ROW
        BEGIN
            IF OLD.Stok_Jual != NEW.Stok_Jual THEN
                INSERT INTO log_stok (ID_Barang, Stok_Jual_Old, Stok_Jual_New)
                VALUES (NEW.ID_Barang, OLD.Stok_Jual, NEW.Stok_Jual);
            END IF;
        END
        ');

        DB::unprepared('
        CREATE TRIGGER after_stok_masuk_update
        AFTER UPDATE ON stok_masuk
        FOR EACH ROW
        BEGIN
            IF OLD.Stok_Masuk != NEW.Stok_Masuk THEN
                INSERT INTO log_stok_masuk (ID_StokMasuk, ID_Barang, Stok_Masuk_Old, Stok_Masuk_New)
                VALUES (OLD.ID_StokMasuk, OLD.ID_Barang, OLD.Stok_Masuk, NEW.Stok_Masuk);
            END IF;
        END
        ');

        DB::unprepared('
        CREATE TRIGGER after_stok_masuk_delete
        AFTER DELETE ON stok_masuk
        FOR EACH ROW
        BEGIN
            INSERT INTO log_stok_masuk (ID_StokMasuk, ID_Barang, Stok_Masuk_Old, Stok_Masuk_New)
            VALUES (OLD.ID_StokMasuk, OLD.ID_Barang, OLD.Stok_Masuk, 0);
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
