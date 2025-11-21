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
        Schema::create('fases', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke tabel segments
            $table->foreignId('segment_id')
                  ->constrained() // Mengasumsikan nama tabel 'segments'
                  ->onDelete('cascade'); // Jika segmen dihapus, fasenya ikut terhapus
                  
            $table->string('name'); // Nama fase (misalnya "Fase 1 — Fundamental")
            $table->integer('order')->default(0); // Urutan fase (untuk sorting)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fases');
    }
};