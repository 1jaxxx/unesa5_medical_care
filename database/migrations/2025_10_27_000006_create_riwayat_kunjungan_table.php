<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('riwayat_kunjungan', function (Blueprint $table) {
            $table->id('id_riwayat_visit');
            $table->foreignId('id_pasien')->constrained('pasien', 'id_pasien');
            $table->foreignId('id_visit')->constrained('visit', 'id_visit');
            $table->date('tgl_kunjungan');
            $table->text('keluhan');
            $table->text('diagnosis');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_kunjungan');
    }
};