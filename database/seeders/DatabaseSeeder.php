<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // UserSeeder::class, // Opsional, tergantung cara Anda membuat user
            UserSeeder::class,
            // HARUS DULUAN: Membuat Segment, Fase, dan Materi
            CourseDataSeeder::class, 
            
            // HARUS KEDUA: Mengisi Langkah-Langkah yang merujuk pada Materi
            StepsTableSeeder::class, 
        ]);
    }
}