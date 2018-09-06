<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengurusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penguruses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_pengurus');
            $table->string('nim');            
            $table->string('fakultas');            
            $table->string('prodi');            
            $table->string('kontak');
            $table->unsignedInteger('divisi_id');
            $table->unsignedInteger('user_id');            
            $table->unsignedInteger('jabatan_id');
            $table->timestamps();
            $table->foreign('divisi_id')->references('id')->on('divisis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jabatan_id')->references('id')->on('jabatans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penguruses');
    }
}
