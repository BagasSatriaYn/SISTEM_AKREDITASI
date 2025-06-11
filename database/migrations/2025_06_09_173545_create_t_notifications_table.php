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
        Schema::create('t_notifications', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('from_user_id')->nullable();
        $table->unsignedBigInteger('kriteria_id')->nullable();
        $table->string('type')->nullable();     // contoh: 'info', 'warning', dst
        $table->string('title')->nullable();
        $table->text('message')->nullable();
        $table->boolean('is_read')->default(false);
        $table->timestamps();

    // opsional: foreign key jika kamu tahu user_id itu relasi ke tabel users
    // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_notifications');
    }
};
