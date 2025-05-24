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
        CREATE TRIGGER after_transaksi_insert AFTER INSERT ON `transaksi` FOR EACH ROW
        BEGIN
            INSERT INTO log_transaksi (ID_Transaksi, Action, Diperbarui)
            VALUES (NEW.ID_Transaksi, "INSERT", CURRENT_TIMESTAMP);
        END;
        
        ');

        DB::unprepared('
        CREATE TRIGGER after_transaksi_update AFTER UPDATE ON `transaksi` FOR EACH ROW
        BEGIN
            INSERT INTO log_transaksi (ID_Transaksi, Action, Diperbarui)
            VALUES (OLD.ID_Transaksi, "UPDATE", CURRENT_TIMESTAMP);
        END;

        ');

        DB::unprepared('
        CREATE TRIGGER after_transaksi_delete AFTER DELETE ON `transaksi` FOR EACH ROW
        BEGIN
            INSERT INTO log_transaksi (ID_Transaksi, Action, Diperbarui)
            VALUES (OLD.ID_Transaksi, "DELETE", CURRENT_TIMESTAMP);
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
