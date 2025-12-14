<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('steps', function (Blueprint $table) {
            // Ubah ke tipe JSON jika Anda menggunakan database modern (disarankan)
            $table->json('quiz_data')->nullable()->change();

            // Atau, ubah ke LONGTEXT jika JSON tidak didukung/bermasalah
            // $table->longText('quiz_data')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('steps', function (Blueprint $table) {
            // Revert jika diperlukan
        });
    }
};