<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('ID_Transaksi');
            $table->enum('Jenis', ['Barang', 'Penitipan']);
            $table->timestamp('Tanggal_Transaksi')->useCurrent();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
