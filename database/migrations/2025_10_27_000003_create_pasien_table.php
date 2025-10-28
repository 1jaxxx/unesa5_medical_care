<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id('id_pasien');
            $table->foreignId('id_prodi')->constrained('prodi', 'id_prodi');
            $table->string('nama');
            $table->enum('type_pasien', ['mahasiswa', 'dosen', 'staff']);
            $table->string('nim')->nullable();
            $table->string('nidn')->nullable();
            $table->string('bagian')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('email');
            $table->string('no_telp');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pasien');
    }
};