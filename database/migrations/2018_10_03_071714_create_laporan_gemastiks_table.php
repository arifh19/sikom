<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanGemastiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_gemastiks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->unsignedInteger('kategori_id');
            $table->string('video')->nullable();
            $table->string('laporan')->nullable();
            $table->string('aplikasi')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoris')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('laporan_gemastiks');
    }
}
