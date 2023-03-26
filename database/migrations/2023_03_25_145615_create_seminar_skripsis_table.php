<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeminarSkripsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminar_skripsis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id');
            $table->foreignId('dosen_id');
            $table->string('rumpun');
            $table->string('doc_proposal');
            $table->string('type_file');
            $table->text('judul');
            $table->integer('tipe_seminar')->comment('1 : Seminar Proposal, 2 : Seminar Payung');
            $table->integer('status')->nullable()->comment('1 : Acc Skripsi, 2 : Tidak Acc Skripsi');
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
        Schema::dropIfExists('seminar_skripsis');
    }
}
