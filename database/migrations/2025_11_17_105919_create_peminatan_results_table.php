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
        Schema::create('peminatan_results', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Kolom untuk Nama Lengkap

            // Skor untuk setiap kategori (total 15 pertanyaan, 3 per kategori)
            // Logika dan Pemrograman (q1, q2, q3)
            $table->tinyInteger('q1');
            $table->tinyInteger('q2');
            $table->tinyInteger('q3');
            // Jaringan dan Infrastruktur (q4, q5, q6)
            $table->tinyInteger('q4');
            $table->tinyInteger('q5');
            $table->tinyInteger('q6');
            // Keamanan Siber (q7, q8, q9)
            $table->tinyInteger('q7');
            $table->tinyInteger('q8');
            $table->tinyInteger('q9');
            // Analisis Data dan AI (q10, q11, q12)
            $table->tinyInteger('q10');
            $table->tinyInteger('q11');
            $table->tinyInteger('q12');
            // Desain Pengalaman Pengguna (q13, q14, q15)
            $table->tinyInteger('q13');
            $table->tinyInteger('q14');
            $table->tinyInteger('q15');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminatan_results');
    }
};