<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('log_stok', function (Blueprint $table) {
            $table->unsignedInteger('ID_Barang')->nullable();
            $table->unsignedInteger('Stok_Jual_Old')->nullable();
            $table->unsignedInteger('Stok_Jual_New')->nullable();
            $table->timestamp('Diperbarui')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_stok');
    }
};
