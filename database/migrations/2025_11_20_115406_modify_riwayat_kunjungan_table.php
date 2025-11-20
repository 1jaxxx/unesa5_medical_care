<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riwayat_kunjungan', function (Blueprint $table) {
            if (Schema::hasColumn('riwayat_kunjungan', 'id_pasien')) {
                // Drop foreign key constraint first
                $table->dropForeign(['id_pasien']);
                // Then drop the column
                $table->dropColumn('id_pasien');
            }

            if (!Schema::hasColumn('riwayat_kunjungan', 'type_pasien')) {
                $table->string('type_pasien')->after('diagnosis');
            }
            if (!Schema::hasColumn('riwayat_kunjungan', 'id_mahasiswa')) {
                $table->foreignId('id_mahasiswa')->nullable()->constrained('mahasiswa', 'id_mahasiswa')->onDelete('set null')->after('type_pasien');
            }
            if (!Schema::hasColumn('riwayat_kunjungan', 'id_dosen')) {
                $table->foreignId('id_dosen')->nullable()->constrained('dosen', 'id_dosen')->onDelete('set null')->after('id_mahasiswa');
            }
            if (!Schema::hasColumn('riwayat_kunjungan', 'id_staff')) {
                $table->foreignId('id_staff')->nullable()->constrained('staff', 'id_staff')->onDelete('set null')->after('id_dosen');
            }
            if (!Schema::hasColumn('riwayat_kunjungan', 'dokter_id')) {
                $table->foreignId('dokter_id')->nullable()->constrained('users', 'id_users')->onDelete('set null')->after('id_staff');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('riwayat_kunjungan', function (Blueprint $table) {
            if (!Schema::hasColumn('riwayat_kunjungan', 'id_pasien')) {
                $table->foreignId('id_pasien')->constrained('pasien', 'id_pasien');
            }

            $table->dropForeign(['id_mahasiswa']);
            $table->dropForeign(['id_dosen']);
            $table->dropForeign(['id_staff']);
            $table->dropForeign(['dokter_id']);

            $table->dropColumn(['type_pasien', 'id_mahasiswa', 'id_dosen', 'id_staff', 'dokter_id']);
        });
    }
};