<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('t_detail_kriteria', function (Blueprint $table) {
        $table->unsignedBigInteger('id_user')->nullable()->after('id_detail_kriteria');

        $table->foreign('id_user')->references('id_user')->on('m_user')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_detail_kriteria', function (Blueprint $table) {
            //
        });
    }
};
