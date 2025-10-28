<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pemberian_obat', function (Blueprint $table) {
            $table->id('id_pemberian');
            $table->foreignId('id_resep')->constrained('resep', 'id_resep');
            $table->date('tgl_diberikan');
            $table->text('cacatan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemberian_obat');
    }
};