<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_steps_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel materis
            $table->foreignId('materi_id')->constrained()->onDelete('cascade');
            $table->integer('order');
            $table->string('title');
            $table->text('content'); // Deskripsi atau instruksi langkah
            $table->string('image_path')->nullable(); // Path gambar step-by-step
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
