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
        Schema::table('steps', function (Blueprint $table) {
            Schema::table('steps', function (Blueprint $table) {
            // Tambahkan kolom JSON untuk menyimpan array link
            $table->json('external_links')->nullable(); 
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('steps', function (Blueprint $table) {
            $table->dropColumn('external_links');
        });
    }
};
