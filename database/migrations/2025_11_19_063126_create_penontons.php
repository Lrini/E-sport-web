_<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenontons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penontons', function (Blueprint $table) {
            $table->id();
            $table->integer('uuid')->unique();
            $table->string('nama_lengkap');
            $table->string('asal_sekolah');
            $table->integer('id_lomba');
            $table->string('image')->nullable();
            $table->integer('id_acara');
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
        Schema::dropIfExists('penonton');
    }
}
