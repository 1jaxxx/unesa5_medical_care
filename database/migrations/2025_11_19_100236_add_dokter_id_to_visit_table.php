<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('visit', function (Blueprint $table) {
            $table->unsignedBigInteger('dokter_id')->nullable()->after('id_staff');

            $table->foreign('dokter_id')->references('id_users')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visit', function (Blueprint $table) {
            $table->dropForeign(['dokter_id']);
            $table->dropColumn('dokter_id');
        });
    }
};
