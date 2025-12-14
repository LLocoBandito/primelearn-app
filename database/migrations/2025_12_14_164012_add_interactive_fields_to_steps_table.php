<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('steps', function (Blueprint $table) {
            $table->string('video_url')->nullable()->after('content');
            $table->json('quiz_data')->nullable()->after('video_url');
            $table->integer('total_steps')->nullable()->after('quiz_data');
        });
    }

    public function down(): void
    {
        Schema::table('steps', function (Blueprint $table) {
            $table->dropColumn(['video_url', 'quiz_data', 'total_steps']);
        });
    }
};
