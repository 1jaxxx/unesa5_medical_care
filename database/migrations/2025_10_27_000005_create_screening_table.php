<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('screening', function (Blueprint $table) {
            $table->id('id_screening');
            $table->foreignId('id_pasien')->constrained('pasien', 'id_pasien');
            $table->foreignId('id_visit')->constrained('visit', 'id_visit');
            $table->date('tgl_screening');
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('tinggi_badan', 5, 2);
            $table->decimal('imt', 5, 2);
            $table->string('pendengaran');
            $table->string('penglihatan');
            $table->string('tekanan_darah');
            $table->string('status_gizi');
            $table->string('kecacatan');
            $table->enum('kebugaran', ['kurang', 'cukup', 'bugar']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('screening');
    }
};