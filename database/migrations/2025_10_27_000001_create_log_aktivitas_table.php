<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id('id_log');
            $table->foreignId('id_users')->constrained('users', 'id_users');
            $table->string('aksi');
            $table->timestamp('waktu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_aktivitas');
    }
};