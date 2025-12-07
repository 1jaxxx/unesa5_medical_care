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
        Schema::table('screening', function (Blueprint $table) {
            $table->unsignedInteger('id_lainnya')->nullable();
            $table->foreign('id_lainnya')->references('id_lainnya')->on('lainnya')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('screening', function (Blueprint $table) {
            $table->dropForeign(['id_lainnya']);
            $table->dropColumn('id_lainnya');
        });
    }
};