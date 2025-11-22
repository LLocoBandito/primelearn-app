<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepImagesTable extends Migration
{
    public function up()
    {
        Schema::create('step_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('step_id')->constrained()->onDelete('cascade');
            $table->string('path');          // path file, misal: steps/namafile.jpg
            $table->integer('order')->default(1); // urutan gambar
            $table->string('caption')->nullable(); // optional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('step_images');
    }
}
