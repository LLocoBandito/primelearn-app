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
        Schema::table('peminatan_results', function (Blueprint $table) {
        // Kami menggunakan 'json' atau 'text' untuk menyimpan array string JSON
        $table->json('matched_categories')->nullable()->after('q15'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminatan_results', function (Blueprint $table) {
         $table->dropColumn('matched_categories');
        });
    }
};
