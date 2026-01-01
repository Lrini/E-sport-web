<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->integer('uuid')->unique();
            $table->string('penanggung_jawab');
            $table->string('nama_sekolah');
            $table->string('no_hp');
            $table->integer('id_lomba');
            $table->integer('id_grade');
            $table->string('image')->nullable();
            $status = ['pending', 'lunas', 'batal'];
             $table->enum('status_pembayaran', $status)->default('pending');
            $table->timestamps();
            $table->string('gdrive_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta');
    }
}
