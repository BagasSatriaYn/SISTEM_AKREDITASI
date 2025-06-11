<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('t_penetapan', function (Blueprint $table) {
            $table->longText('deskripsi')->change();
            $table->longText('pendukung')->change();
        });

        Schema::table('t_pelaksanaan', function (Blueprint $table) {
            $table->longText('deskripsi')->change();
            $table->longText('pendukung')->change();
        });

        Schema::table('t_evaluasi', function (Blueprint $table) {
            $table->longText('deskripsi')->change();
            $table->longText('pendukung')->change();
        });

        Schema::table('t_pengendalian', function (Blueprint $table) {
            $table->longText('deskripsi')->change();
            $table->longText('pendukung')->change();
        });

        Schema::table('t_peningkatan', function (Blueprint $table) {
            $table->longText('deskripsi')->change();
            $table->longText('pendukung')->change();
        });
    }

    public function down(): void
    {
        Schema::table('t_penetapan', function (Blueprint $table) {
            $table->text('deskripsi')->change();
            $table->text('pendukung')->change();
        });

        Schema::table('t_pelaksanaan', function (Blueprint $table) {
            $table->text('deskripsi')->change();
            $table->text('pendukung')->change();
        });

        Schema::table('t_evaluasi', function (Blueprint $table) {
            $table->text('deskripsi')->change();
            $table->text('pendukung')->change();
        });

        Schema::table('t_pengendalian', function (Blueprint $table) {
            $table->text('deskripsi')->change();
            $table->text('pendukung')->change();
        });

        Schema::table('t_peningkatan', function (Blueprint $table) {
            $table->text('deskripsi')->change();
            $table->text('pendukung')->change();
        });
    }
};
