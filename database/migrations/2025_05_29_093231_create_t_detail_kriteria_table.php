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
        Schema::create('t_detail_kriteria', function (Blueprint $table) {
            $table->id('id_detail_kriteria');
            $table->unsignedBigInteger('id_kriteria')->index();
            $table->unsignedBigInteger('id_penetapan')->index();
            $table->unsignedBigInteger('id_pelaksanaan')->index();
            $table->unsignedBigInteger('id_evaluasi')->index();
            $table->unsignedBigInteger('id_pengendalian')->index();
            $table->unsignedBigInteger('id_peningkatan')->index();
            $table->unsignedBigInteger('id_finalisasi')->index();
            $table->unsignedBigInteger('id_komentar')->nullable()->index();  
            $table->enum('status',['submitted','save','revisi','acc1','acc2']);
            $table->timestamps();

            $table->foreign('id_kriteria')->references('id_kriteria')->on('t_kriteria');
            $table->foreign('id_penetapan')->references('id_penetapan')->on('t_penetapan');
            $table->foreign('id_pelaksanaan')->references('id_pelaksanaan')->on('t_pelaksanaan');
            $table->foreign('id_evaluasi')->references('id_evaluasi')->on('t_evaluasi');
            $table->foreign('id_pengendalian')->references('id_pengendalian')->on('t_pengendalian');
            $table->foreign('id_peningkatan')->references('id_peningkatan')->on('t_peningkatan');
            $table->foreign('id_finalisasi')->references('id_finalisasi')->on('t_finalisasi')->onDelete('cascade');
            $table->foreign('id_komentar')->references('id_komentar')->on('t_komentar');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_detail_kriteria');
    }
};
