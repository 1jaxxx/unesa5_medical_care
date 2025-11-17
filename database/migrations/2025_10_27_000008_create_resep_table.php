<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('resep', function (Blueprint $table) {
            $table->id('id_resep');
            $table->foreignId('id_obat')->constrained('obat', 'id_obat');
            $table->foreignId('id_visit')->constrained('visit', 'id_visit');
            $table->string('dosis');
            $table->integer('jumlah');
            $table->date('tgl_diberikan');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resep');
    }
};