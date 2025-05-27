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
        Schema::table('t_komentar', function (Blueprint $table) {
            // Drop foreign key jika ada
            try {
                $table->dropForeign(['id_detail_kriteria']);
            } catch (\Throwable $e) {
                // Ignore error if FK not exist
            }

            // Drop kolom
            if (Schema::hasColumn('t_komentar', 'id_detail_kriteria')) {
                $table->dropColumn('id_detail_kriteria');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_komentar', function (Blueprint $table) {
            $table->unsignedBigInteger('id_detail_kriteria')->index();
            $table->foreign('id_detail_kriteria')->references('id_detail_kriteria')->on('t_detail_kriteria');
        });
    }
};
