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

            // 1. Hapus referensi ke tabel 'pasien' (karena tabelnya sudah tidak ada)
            // $table->foreignId('id_pasien')->constrained('pasien', 'id_pasien'); <--- HAPUS INI

            // 2. Ganti dengan struktur baru (Type + 3 Foreign Keys)
            $table->string('type_pasien')->nullable(); // mahasiswa, dosen, atau staff
            
            $table->foreignId('id_mahasiswa')->nullable()
                  ->constrained('mahasiswa', 'id_mahasiswa')->onDelete('set null');

            $table->foreignId('id_dosen')->nullable()
                  ->constrained('dosen', 'id_dosen')->onDelete('set null');

            $table->foreignId('id_staff')->nullable()
                  ->constrained('staff', 'id_staff')->onDelete('set null');

            // 3. Data Screening lainnya (Tetap sama)
            $table->foreignId('id_visit')->constrained('visit', 'id_visit')->onDelete('cascade');
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