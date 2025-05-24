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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->increments('ID_Keranjang');
            $table->unsignedInteger('ID_Transaksi')->nullable(true);
            $table->foreign('ID_Transaksi')->references('ID_Transaksi')->on('transaksi')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedInteger('ID_Barang')->nullable(false);
            $table->unsignedInteger('ID_Pengguna')->nullable(false);
            $table->unsignedInteger('ID_Kategori')->nullable(false);
            $table->string('Barang')->nullable(false);
            $table->string('Pengguna')->nullable(false);
            $table->enum('Peran', ['Admin', 'Pelanggan', 'Kasir'])->default('Pelanggan');
            $table->string('Nama_Kategori')->nullable((false));
            $table->decimal('Harga_Satuan', 10, 2)->nullable(false);
            $table->string('deskripsi')->nullable('false');
            $table->timestamp('Dibeli')->useCurrent();
            $table->unsignedInteger('jumlah_stok_dipesan')->nullable(false);
            $table->string('gambar'); 
            $table->enum('status', ['Keranjang', 'Menunggu_Pembayaran', 'Berhasil', 'Gagal', 'Offline', 'Selesai'])->default('Keranjang')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangjuals');
    }
};
