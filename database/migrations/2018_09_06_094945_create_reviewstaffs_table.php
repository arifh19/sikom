<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewstaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviewstaffs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('riwayat_proposal_id');
            $table->unsignedInteger('pengurus_id');
            $table->unsignedInteger('divisi_id');
            $table->timestamps();
            $table->foreign('riwayat_proposal_id')->references('id')->on('riwayat_proposals')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('divisi_id')->references('id')->on('divisis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pengurus_id')->references('id')->on('penguruses')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviewstaffs');
    }
}
