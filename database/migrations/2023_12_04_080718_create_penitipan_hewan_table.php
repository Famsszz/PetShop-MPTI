<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penitipan_hewan', function (Blueprint $table) {
            $table->increments('ID_Penitipan');
            $table->unsignedInteger('ID_Transaksi');
            $table->foreign('ID_Transaksi')->references('ID_Transaksi')->on('transaksi')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedInteger('ID_Pengguna')->nullable(false);
            $table->string('Nama_Pengguna')->nullable(false);
            $table->enum('Peran', ['Admin', 'Pelanggan', 'Kasir']);
            $table->string('Nama_Hewan')->nullable(false);
            $table->date('Tanggal');
            $table->integer('Lama_Hari')->default(1);
            $table->enum('Jenis_Layanan', ['penitipan', 'grooming', 'penitipan_dan_grooming'])->nullable(false);
            $table->decimal('Harga', 10, 2)->nullable(false);
            $table->string('gambar');
            $table->enum('status', ['Keranjang_Penitipan', 'Menunggu_Pembayaran', 'Berhasil', 'Gagal', 'Offline', 'Selesai'])->default('Menunggu_Pembayaran')->nullable(false);
            $table->timestamp('Dipesan')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penitipan_hewan');
    }
};
