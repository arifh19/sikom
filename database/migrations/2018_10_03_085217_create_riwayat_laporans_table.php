<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_laporans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('laporan_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('status');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('laporan_id')->references('id')->on('laporan_gemastiks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_laporans');
    }
}
