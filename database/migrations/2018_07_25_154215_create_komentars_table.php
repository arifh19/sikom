<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKomentarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('komentars', function (Blueprint $table){
            $table->increments('id');
            //animasi
            $table->string('Ide_konsep_keaslian')->nullable();
            $table->string('Konsistensi_tema')->nullable();
            $table->string('Kreativitas_dalam_implementasi')->nullable();
            $table->string('Teknik_modelling_lighting_motion')->nullable();
            $table->string('Kekuatan pesan, artistik')->nullable();
            //desain ux
            $table->string('Interaktivitas_dan_Potensi')->nullable();
            $table->string('Orisinalitas_dan_Keunikan')->nullable();
            $table->string('Metode_Desain')->nullable();
            $table->string('Komunikasi_dengan_Media_Poster')->nullable();
            //data mining
            $table->string('Solusi_permasalahan_dan_manfaat')->nullable();
            $table->string('Kritik_Saran')->nullable();
            //game dev
            $table->string('Story')->nullable();
            $table->string('Mechanics')->nullable();
            $table->string('Aesthetics')->nullable();
            $table->string('Gameplay')->nullable();
            //Bisnis TIK
            $table->string('Penjelasan_Problem_Bisnis')->nullable();
            $table->string('Produk_Layanan')->nullable();
            $table->string('Pasar_Market')->nullable();
            $table->string('Strategi_Bisnis')->nullable();
            $table->string('Anggota_Perusahaan')->nullable();
            $table->string('Daya_Tarik_Traction')->nullable();
            $table->string('Elevator_Pitch')->nullable();
            //PPL
            $table->string('Aspek_Inovasi')->nullable();
            $table->string('Dampak_pengguna_masyarakat')->nullable();
            $table->string('Desain_dan_usability')->nullable();
            $table->string('metodologi_pengembangan')->nullable();
            $table->string('Kesesuaian_ide')->nullable();
            $table->string('Urgensi_permasalahan')->nullable();
            //Piranti Cerdas
            $table->string('Aspek_kreativitas')->nullable();
            $table->string('Penulisan_proposal')->nullable();
            $table->string('Potensi_Kegunaan_Hasil_Bagi_Masyarakat')->nullable();
            $table->string('Kemungkinan_Proposal_Dapat_Diselesaikan')->nullable();
            //Smart City
            $table->string('Permasalahan_yang_diangkat')->nullable();
            $table->string('Pemaparan_permasalahan')->nullable();
            $table->string('Dampak_implementasi')->nullable();
            $table->string('Inovasi_pengembangan')->nullable();
            
            $table->unsignedInteger('proposal_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('proposal_id')->references('id')->on('proposals');
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
        Schema::dropIfExists('komentars');
    }
}
