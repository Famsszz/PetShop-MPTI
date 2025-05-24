<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('ID_Pengguna');
            $table->string('Nama_Akun')->nullable(false);
            $table->string('Nama_Pengguna')->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('No_Telp')->nullable(false);
            $table->string('email')->nullable(false)->unique();
            $table->string('email_verified_at')->nullable();
            $table->string('reset_token')->nullable();
            $table->enum('Peran', ['Admin', 'Pelanggan', 'Kasir'])->default('Pelanggan');
            $table->timestamp('Dibuat')->useCurrent();
        });
    }

    /** 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
