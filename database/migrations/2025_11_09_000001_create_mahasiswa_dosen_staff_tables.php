<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // NOTE: do not drop `pasien` yet — first update related tables to remove FK references.

        // Create mahasiswa table
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->foreignId('id_prodi')->constrained('prodi', 'id_prodi');
            $table->string('nama');
            $table->string('nim');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('email');
            $table->string('no_telp');
            $table->timestamps();
        });

        // Create dosen table
        Schema::create('dosen', function (Blueprint $table) {
            $table->id('id_dosen');
            $table->string('nama');
            $table->string('nidn');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('email');
            $table->string('no_telp');
            $table->timestamps();
        });

        // Create staff table
        Schema::create('staff', function (Blueprint $table) {
            $table->id('id_staff');
            $table->string('nama');
            $table->string('bagian');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('email');
            $table->string('no_telp');
            $table->timestamps();
        });

        // Update related tables that reference pasien (use correct table names)
        Schema::table('visit', function (Blueprint $table) {
            // drop FK to pasien first so we can remove the pasien table later
            if (Schema::hasColumn('visit', 'id_pasien')) {
                $table->dropForeign(['id_pasien']);
                $table->dropColumn('id_pasien');
            }
            $table->string('type_pasien')->nullable();
            $table->unsignedBigInteger('id_mahasiswa')->nullable();
            $table->unsignedBigInteger('id_dosen')->nullable();
            $table->unsignedBigInteger('id_staff')->nullable();
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen');
            $table->foreign('id_staff')->references('id_staff')->on('staff');
        });

        Schema::table('screening', function (Blueprint $table) {
            if (Schema::hasColumn('screening', 'id_pasien')) {
                $table->dropForeign(['id_pasien']);
                $table->dropColumn('id_pasien');
            }
            $table->string('type_pasien')->nullable();
            $table->unsignedBigInteger('id_mahasiswa')->nullable();
            $table->unsignedBigInteger('id_dosen')->nullable();
            $table->unsignedBigInteger('id_staff')->nullable();
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen');
            $table->foreign('id_staff')->references('id_staff')->on('staff');
        });

        Schema::table('riwayat_kunjungan', function (Blueprint $table) {
            if (Schema::hasColumn('riwayat_kunjungan', 'id_pasien')) {
                $table->dropForeign(['id_pasien']);
                $table->dropColumn('id_pasien');
            }
            $table->string('type_pasien')->nullable();
            $table->unsignedBigInteger('id_mahasiswa')->nullable();
            $table->unsignedBigInteger('id_dosen')->nullable();
            $table->unsignedBigInteger('id_staff')->nullable();
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen');
            $table->foreign('id_staff')->references('id_staff')->on('staff');
        });

        // Now it's safe to drop the old pasien table
        Schema::dropIfExists('pasien');
    }

    public function down()
    {
        // Restore original pasien table
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

        // Restore original foreign keys in related tables
        Schema::table('visits', function (Blueprint $table) {
            $table->dropForeign(['id_mahasiswa']);
            $table->dropForeign(['id_dosen']);
            $table->dropForeign(['id_staff']);
            $table->dropColumn(['type_pasien', 'id_mahasiswa', 'id_dosen', 'id_staff']);
            $table->foreignId('id_pasien')->constrained('pasien', 'id_pasien');
        });

        Schema::table('screenings', function (Blueprint $table) {
            $table->dropForeign(['id_mahasiswa']);
            $table->dropForeign(['id_dosen']);
            $table->dropForeign(['id_staff']);
            $table->dropColumn(['type_pasien', 'id_mahasiswa', 'id_dosen', 'id_staff']);
            $table->foreignId('id_pasien')->constrained('pasien', 'id_pasien');
        });

        Schema::table('riwayat_kunjungan', function (Blueprint $table) {
            $table->dropForeign(['id_mahasiswa']);
            $table->dropForeign(['id_dosen']);
            $table->dropForeign(['id_staff']);
            $table->dropColumn(['type_pasien', 'id_mahasiswa', 'id_dosen', 'id_staff']);
            $table->foreignId('id_pasien')->constrained('pasien', 'id_pasien');
        });

        Schema::dropIfExists('mahasiswa');
        Schema::dropIfExists('dosen');
        Schema::dropIfExists('staff');
    }
};