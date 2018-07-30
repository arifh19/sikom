<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('nama_ketua');
            $table->string('nim_ketua');
            $table->string('fkja_ketua');
            $table->string('no_hp_ketua');
            $table->string('foto_ktm_ketua');
            $table->string('nama_anggota1')->nullable();
            $table->string('nim_anggota1')->nullable();
            $table->string('fkja_anggota1')->nullable();         
            $table->string('no_hp_anggota1')->nullable();
            $table->string('foto_ktm_anggota1')->nullable();
            $table->string('nama_anggota2')->nullable();
            $table->string('nim_anggota3')->nullable();
            $table->string('fkja_anggota2')->nullable();                    
            $table->string('no_hp_anggota2')->nullable();
            $table->string('foto_ktm_anggota2')->nullable();
            $table->string('nama_dosbing')->nullable();
            $table->string('nidn')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('teams');
    }
}
