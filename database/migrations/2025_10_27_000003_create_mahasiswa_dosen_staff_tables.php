<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Create mahasiswa table
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            // Pastikan tabel 'prodi' sudah ada sebelumnya (timestamp file prodi harus lebih kecil)
            $table->foreignId('id_prodi')->constrained('prodi', 'id_prodi')->onDelete('cascade'); 
            $table->string('nama');
            $table->string('nim')->unique(); // Tambahkan unique biar aman
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('email')->unique();
            $table->string('no_telp');
            $table->timestamps();
        });

        // 2. Create dosen table
        Schema::create('dosen', function (Blueprint $table) {
            $table->id('id_dosen');
            $table->string('nama');
            $table->string('nidn')->unique();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('email')->unique();
            $table->string('no_telp');
            $table->timestamps();
        });

        // 3. Create staff table
        Schema::create('staff', function (Blueprint $table) {
            $table->id('id_staff');
            $table->string('nama');
            $table->string('bagian');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('email')->unique();
            $table->string('no_telp');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff');
        Schema::dropIfExists('dosen');
        Schema::dropIfExists('mahasiswa');
    }
};