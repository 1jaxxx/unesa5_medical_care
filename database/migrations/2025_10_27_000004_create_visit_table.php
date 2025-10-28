<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visit', function (Blueprint $table) {
            $table->id('id_visit');
            $table->foreignId('id_pasien')->constrained('pasien', 'id_pasien');
            $table->date('tgl_kunjungan');
            $table->text('keluhan');
            $table->text('diagnosis');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visit');
    }
};