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
            $table->string('type_pasien');
            $table->foreignId('id_mahasiswa')->nullable()->constrained('mahasiswa', 'id_mahasiswa')->onDelete('set null');
            $table->foreignId('id_dosen')->nullable()->constrained('dosen', 'id_dosen')->onDelete('set null');
            $table->foreignId('id_staff')->nullable()->constrained('staff', 'id_staff')->onDelete('set null');
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
