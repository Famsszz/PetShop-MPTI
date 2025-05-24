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
        
        CREATE TRIGGER after_pengguna_insert AFTER INSERT ON `users` FOR EACH ROW
        BEGIN
            INSERT INTO log_pengguna (ID_Pengguna, Action, Nama_Akun_New, Nama_Pengguna_New, No_Telp_New, Email_New, Peran_New, Diperbarui)
            VALUES (NEW.ID_Pengguna, "INSERT", NEW.Nama_Akun, NEW.Nama_Pengguna, NEW.No_Telp, NEW.Email, NEW.Peran, CURRENT_TIMESTAMP);
        END
        
        ');


        DB::unprepared('
        CREATE TRIGGER after_pengguna_update AFTER UPDATE ON `users` FOR EACH ROW
        BEGIN
            INSERT INTO log_pengguna (ID_Pengguna, Action, Nama_Akun_Old, Nama_Pengguna_Old, No_Telp_Old, Email_Old, Peran_Old,
                                    Nama_Akun_New, Nama_Pengguna_New, No_Telp_New, Email_New, Peran_New, Diperbarui)
            VALUES (OLD.ID_Pengguna, "UPDATE", OLD.Nama_Akun, OLD.Nama_Pengguna, OLD.No_Telp, OLD.Email, OLD.Peran,
                    NEW.Nama_Akun, NEW.Nama_Pengguna, NEW.No_Telp, NEW.Email, NEW.Peran, CURRENT_TIMESTAMP);
        END
        ');


        DB::unprepared('
        CREATE TRIGGER after_pengguna_delete AFTER DELETE ON `users` FOR EACH ROW
        BEGIN
            INSERT INTO log_pengguna (ID_Pengguna, Action, Nama_Akun_Old, Nama_Pengguna_Old, No_Telp_Old, Email_Old, Peran_Old, Diperbarui)
            VALUES (OLD.ID_Pengguna, "DELETE", OLD.Nama_Akun, OLD.Nama_Pengguna, OLD.No_Telp, OLD.Email, OLD.Peran, CURRENT_TIMESTAMP);
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
