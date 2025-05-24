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
        Schema::create('log_pengguna', function (Blueprint $table) {
            $table->unsignedInteger('ID_Pengguna');
            $table->string('Action');
            $table->string('Nama_Akun_Old')->nullable(); // Remove unique
            $table->string('Nama_Akun_New')->nullable();
            $table->string('Nama_Pengguna_Old')->nullable(); // Remove unique
            $table->string('Nama_Pengguna_New')->nullable(); // Remove unique
            $table->string('No_Telp_Old')->nullable();
            $table->string('No_Telp_New')->nullable();
            $table->string('Email_Old')->nullable();
            $table->string('Email_New')->nullable();
            $table->string('Peran_Old')->nullable();
            $table->string('Peran_New')->nullable();
            $table->timestamp('Diperbarui')->useCurrent();

        });

       
    }

    public function down()
    {
        Schema::dropIfExists('log_pengguna');
    }
};
