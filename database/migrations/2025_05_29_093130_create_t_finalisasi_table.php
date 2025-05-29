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
        Schema::create('t_finalisasi', function (Blueprint $table) {
            $table->id('id_finalisasi');   // ✅ Sudah dikutip string
            $table->string('name', 255);   // ✅ Kolom name
            $table->timestamps();          // ✅ created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_finalisasi');
    }
};
