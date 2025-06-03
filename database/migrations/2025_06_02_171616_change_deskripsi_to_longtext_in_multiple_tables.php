<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDeskripsiToLongtextInMultipleTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = ['t_penetapan', 't_pelaksanaan', 't_evaluasi', 't_pengendalian', 't_peningkatan'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->longText('deskripsi')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['t_penetapan', 't_pelaksanaan', 't_evaluasi', 't_pengendalian', 't_peningkatan'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->text('deskripsi')->nullable()->change();
            });
        }
    }
}
