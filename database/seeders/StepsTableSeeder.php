<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;
use App\Models\Step;
use Illuminate\Support\Facades\DB;

class StepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Membersihkan tabel Steps
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Step::truncate(); 
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // --- Data Per Materi ---

        // ==========================================================
        // MATERI 1: Logika pemrograman
        // ==========================================================
        $materiLogika = Materi::where('title', 'Logika pemrograman')->first();

        if ($materiLogika) {
            $stepsLogika = [
                [
                    'order' => 1,
                    'title' => 'Konsep Dasar: Algoritma & Pseudocode',
                    'content' => 'Pahami definisi Algoritma sebagai urutan logis penyelesaian masalah. Selalu rancang dalam bentuk Pseudocode sebelum mengimplementasikannya dalam bahasa pemrograman.',
                    'image_path' => 'images/step/logika/step_1_algoritma.png', 
                ],
                [
                    'order' => 2,
                    'title' => 'Struktur Kontrol Kondisional (If/Else)',
                    'content' => 'Pelajari cara menggunakan If, Else If, dan Else untuk mengontrol alur program berdasarkan kondisi Boolean. Latih penggunaan operator logika (AND, OR, NOT).',
                    'image_path' => 'images/step/logika/step_2_if_else.png', 
                ],
                [
                    'order' => 3,
                    'title' => 'Perulangan Dasar (For dan While Loop)',
                    'content' => 'Terapkan perulangan For (untuk iterasi terbatas) dan While (untuk iterasi berdasarkan kondisi) untuk mengotomatisasi tugas berulang.',
                    'image_path' => 'images/step/logika/step_3_loop.png', 
                ],
            ];
            $materiLogika->steps()->createMany($stepsLogika);
        }
        
        // ==========================================================
        // MATERI 2: Bahasa pemrograman dasar (Python/JavaScript/Java)
        // ==========================================================
        $materiBahasa = Materi::where('title', 'Bahasa pemrograman dasar (Python/JavaScript/Java)')->first();

        if ($materiBahasa) {
            $stepsBahasa = [
                [
                    'order' => 1,
                    'title' => 'Sintaks Dasar dan Hello World',
                    'content' => 'Kenali sintaks dasar bahasa yang dipilih dan buat program "Hello World" pertama Anda. Pahami cara kompilasi atau eksekusi.',
                    'image_path' => 'images/step/bahasa/step_1_syntax.png', 
                ],
                [
                    'order' => 2,
                    'title' => 'Deklarasi Variabel dan Tipe Data',
                    'content' => 'Pelajari cara mendeklarasikan variabel dan memahami implementasi tipe data (String, Number, Array) dalam bahasa tersebut.',
                    'image_path' => 'images/step/bahasa/step_2_variable.png', 
                ],
                [
                    'order' => 3,
                    'title' => 'Fungsi/Metode Dasar',
                    'content' => 'Pahami cara mendefinisikan dan memanggil fungsi, serta konsep input (parameter) dan output (return value).',
                    'image_path' => 'images/step/bahasa/step_3_function.png', 
                ],
            ];
            $materiBahasa->steps()->createMany($stepsBahasa);
        }

        // ==========================================================
        // MATERI 3: Git & GitHub
        // ==========================================================
        $materiGit = Materi::where('title', 'Git & GitHub')->first();

        if ($materiGit) {
            $stepsGit = [
                [
                    'order' => 1,
                    'title' => 'Inisialisasi Repositori Lokal',
                    'content' => 'Lakukan `git init` di proyek Anda dan konfigurasikan nama dan email pengguna secara global. Pahami konsep *staging area*.',
                    'image_path' => 'images/step/git/step_1_init.png', 
                ],
                [
                    'order' => 2,
                    'title' => 'Commit dan Status',
                    'content' => 'Latih perintah `git add`, `git status`, dan `git commit` untuk menyimpan *snapshot* perubahan kode Anda secara efektif.',
                    'image_path' => 'images/step/git/step_2_commit.png', 
                ],
                [
                    'order' => 3,
                    'title' => 'Push, Pull, dan Remote',
                    'content' => 'Hubungkan repositori lokal Anda dengan GitHub (`git remote add origin`) dan kuasai `git push` dan `git pull` untuk berkolaborasi.',
                    'image_path' => 'images/step/git/step_3_push_pull.png', 
                ],
            ];
            $materiGit->steps()->createMany($stepsGit);
        }
        
        // ==========================================================
        // MATERI 4: Struktur data dasar (array, list, stack, queue)
        // ==========================================================
        $materiStrukturData = Materi::where('title', 'Struktur data dasar (array, list, stack, queue)')->first();

        if ($materiStrukturData) {
            $stepsStrukturData = [
                [
                    'order' => 1,
                    'title' => 'Pengantar Array dan List',
                    'content' => 'Pahami struktur array (ukuran tetap) dan list (ukuran dinamis). Latih operasi dasar seperti *insertion* dan *deletion* di indeks tertentu.',
                    'image_path' => 'images/step/struktur/step_1_array.png', 
                ],
                [
                    'order' => 2,
                    'title' => 'Mengenal Stack (LIFO)',
                    'content' => 'Pelajari struktur Stack (Last-In, First-Out). Terapkan operasi `push` (masukkan) dan `pop` (keluarkan) serta penggunaan di memori program.',
                    'image_path' => 'images/step/struktur/step_2_stack.png', 
                ],
                [
                    'order' => 3,
                    'title' => 'Mengenal Queue (FIFO)',
                    'content' => 'Pelajari struktur Queue (First-In, First-Out). Terapkan operasi `enqueue` (masukkan) dan `dequeue` (keluarkan) dan contoh penggunaannya (misalnya, *task scheduling*).',
                    'image_path' => 'images/step/struktur/step_3_queue.png', 
                ],
            ];
            $materiStrukturData->steps()->createMany($stepsStrukturData);
        }

        // ==========================================================
        // MATERI 5: Pemahaman API
        // ==========================================================
        $materiAPI = Materi::where('title', 'Pemahaman API')->first();

        if ($materiAPI) {
            $stepsAPI = [
                [
                    'order' => 1,
                    'title' => 'Apa itu API dan RESTful API?',
                    'content' => 'Pahami definisi Application Programming Interface (API) sebagai jembatan komunikasi. Kenali standar desain REST (Representational State Transfer).',
                    'image_path' => 'images/step/api/step_1_konsep.png', 
                ],
                [
                    'order' => 2,
                    'title' => 'Metode HTTP Dasar',
                    'content' => 'Pelajari empat metode HTTP utama yang digunakan dalam REST: GET (ambil data), POST (kirim/buat data), PUT (ubah data), dan DELETE (hapus data).',
                    'image_path' => 'images/step/api/step_2_methods.png', 
                ],
                [
                    'order' => 3,
                    'title' => 'Request dan Response Format (JSON)',
                    'content' => 'Pahami bahwa API modern menggunakan format JSON (JavaScript Object Notation) untuk mengirim dan menerima data. Latih membaca dan memformat JSON.',
                    'image_path' => 'images/step/api/step_3_json.png', 
                ],
            ];
            $materiAPI->steps()->createMany($stepsAPI);
        }
    }
}