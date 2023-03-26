<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartuBimbinganSkripsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_bimbingan_skripsis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seminar_skripsi_id');
            $table->date('tanggal')->nullable();
            $table->string('bab');
            $table->string('evaluasi');
            $table->foreignId('tahun_akademik_id');
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
        Schema::dropIfExists('kartu_bimbingan_skripsis');
    }
}
