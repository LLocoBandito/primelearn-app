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
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke tabel fases
            $table->foreignId('fase_id')
                  ->constrained() // Mengasumsikan nama tabel 'fases'
                  ->onDelete('cascade'); // Jika fase dihapus, materinya ikut terhapus
                  
            $table->string('title'); // Judul materi (misalnya "Logika pemrograman")
            $table->integer('order')->default(0); // Urutan materi dalam fase
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};