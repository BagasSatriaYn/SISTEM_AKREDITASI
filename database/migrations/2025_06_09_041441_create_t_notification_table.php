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
            $table->id('id_notification');
            $table->unsignedBigInteger('user_id'); // Penerima notifikasi
            $table->unsignedBigInteger('from_user_id'); // Pengirim notifikasi
            $table->unsignedBigInteger('kriteria_id')->nullable(); // ID kriteria yang terkait
            $table->string('type', 50); // Type: 'submission', 'approval', 'rejection', 'revision'
            $table->string('title', 255); // Judul notifikasi
            $table->text('message'); // Isi pesan notifikasi
            $table->boolean('is_read')->default(false); // Status sudah dibaca atau belum
            $table->timestamps();

            $table->foreign('user_id')->references('id_user')->on('m_user')->onDelete('cascade');
            $table->foreign('from_user_id')->references('id_user')->on('m_user')->onDelete('cascade');
            $table->foreign('kriteria_id')->references('id_kriteria')->on('t_kriteria')->onDelete('set null');
            
            $table->index(['user_id', 'is_read']);
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