<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_log_activity', function (Blueprint $table) {
            $table->id('id_log');
            $table->unsignedBigInteger('id_user');
            $table->string('aktivitas');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('m_user')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_log_activity');
    }
};
