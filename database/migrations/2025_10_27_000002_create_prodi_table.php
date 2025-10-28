<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prodi', function (Blueprint $table) {
            $table->id('id_prodi');
            $table->string('nama_prodi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prodi');
    }
};