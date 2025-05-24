<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('log_penitipan_hewan', function (Blueprint $table) {
            $table->unsignedInteger('ID_Penitipan')->nullable();   
            $table->unsignedInteger('ID_Pengguna')->nullable();
            $table->string('Action')->nullable();
            $table->string('Nama_Hewan_Old')->nullable();
            $table->string('Nama_Hewan_New')->nullable();
            $table->integer('Lama_Hari_Old')->nullable();
            $table->integer('Lama_Hari_New')->nullable();
            $table->enum('Jenis_Layanan_Old', ['penitipan', 'grooming', 'penitipan_dan_grooming'])->nullable();
            $table->enum('Jenis_Layanan_New', ['penitipan', 'grooming', 'penitipan_dan_grooming'])->nullable();
            $table->decimal('Harga_Old', 10, 2)->nullable();
            $table->decimal('Harga_New', 10, 2)->nullable();
            $table->timestamp('Diperbarui')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_penitipan_hewan');
    }
};
