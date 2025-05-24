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
        Schema::create('log_barangjual', function (Blueprint $table) {
            $table->unsignedInteger('ID_barangjual')->nullable();
            $table->unsignedInteger('ID_Transaksi')->nullable();
            $table->string('Barang')->nullable();
            $table->string('Pengguna')->nullable();
            $table->string('action')->nullable();
            $table->decimal('Harga_Satuan_Old', 10, 2)->nullable();
            $table->decimal('Harga_Satuan_New', 10, 2)->nullable();
            $table->integer('jumlah_stok_dipesan_Old')->nullable();
            $table->integer('jumlah_stok_dipesan_New')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_barangjuals');
    }
};
