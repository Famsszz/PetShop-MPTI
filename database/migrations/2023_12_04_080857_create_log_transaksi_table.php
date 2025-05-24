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
        Schema::create('log_transaksi', function (Blueprint $table) {
            $table->unsignedInteger('ID_Transaksi')->nullable();
            $table->string('Action')->nullable();
            $table->timestamp('Diperbarui')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_transaksi');
    }
};
