<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stok_masuk', function (Blueprint $table) {
            $table->increments('ID_StokMasuk');
            $table->unsignedInteger('ID_Barang');
            $table->foreign('ID_Barang')->references('ID_Barang')->on('barang')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedInteger('Stok_Masuk')->nullable(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok_masuk');
    }
};
