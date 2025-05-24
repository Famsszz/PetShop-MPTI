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
        Schema::create('log_barang', function (Blueprint $table) {
            $table->unsignedInteger('ID_Barang')->nullable();
            $table->string('Action')->nullable();
            $table->string('Nama_Barang_Old')->nullable();
            $table->string('Nama_Barang_New')->nullable();
            $table->decimal('Harga_Satuan_Old', 10, 2)->nullable();
            $table->decimal('Harga_Satuan_New', 10, 2)->nullable();
            $table->enum('Status_Old', ['jual', 'adopsi'])->nullable();
            $table->enum('Status_New', ['jual', 'adopsi'])->nullable();
            $table->string('deskripsi_Old')->nullable();
            $table->string('deskripsi_New')->nullable();
            $table->string('gambar_Old')->nullable();
            $table->string('gambar_New')->nullable();
            $table->timestamp('Diperbarui')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_barang');
    }
};
