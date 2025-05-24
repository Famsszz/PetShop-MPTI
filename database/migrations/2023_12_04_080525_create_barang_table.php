<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('ID_Barang');
            $table->string('Nama_Barang')->nullable(false);
            $table->decimal('Harga_Satuan', 10, 2)->nullable(false);
            $table->enum('Status', ['jual', 'adopsi'])->nullable(false);
            $table->integer('Stok_Jual');
            $table->unsignedInteger('ID_Kategori');
            $table->foreign('ID_Kategori')->references('ID_Kategori')->on('kategori')->onDelete('CASCADE');
            $table->string('deskripsi');
            $table->string('gambar');
            $table->timestamp('Dibuat')->useCurrent();
        });

    }

    public function down()
    {
        Schema::dropIfExists('barang');
    }
};
