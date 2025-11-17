<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminatanResult;

class PeminatanController extends Controller
{
    /**
     * Menampilkan formulir.
     */
    public function index()
    {
        return view('apply'); // Pastikan path view sesuai (peminatan/form.blade.php)
    }

    /**
     * Menyimpan data formulir ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'q1' => 'required|integer|between:1,4',
            'q2' => 'required|integer|between:1,4',
            'q3' => 'required|integer|between:1,4',
            'q4' => 'required|integer|between:1,4',
            'q5' => 'required|integer|between:1,4',
            'q6' => 'required|integer|between:1,4',
            'q7' => 'required|integer|between:1,4',
            'q8' => 'required|integer|between:1,4',
            'q9' => 'required|integer|between:1,4',
            'q10' => 'required|integer|between:1,4',
            'q11' => 'required|integer|between:1,4',
            'q12' => 'required|integer|between:1,4',
            'q13' => 'required|integer|between:1,4',
            'q14' => 'required|integer|between:1,4',
            'q15' => 'required|integer|between:1,4',
        ]);

        // 2. Simpan Data ke Database
        $result = PeminatanResult::create($validatedData);

        // 3. Hitung Skor Peminatan dan Tentukan Hasil (Logika Utama)
        $scores = $this->calculateScores($validatedData);
        $recommendation = $this->getRecommendation($scores);

        // 4. Redirect atau Tampilkan Hasil
        return view('result', compact('result', 'scores', 'recommendation'));
        // return redirect()->route('peminatan.result', $result->id)->with('success', 'Formulir berhasil disimpan!');
    }

    /**
     * Menghitung total skor per kategori.
     */
    private function calculateScores(array $data): array
    {
        $scores = [];

        // I. Logika dan Pemrograman (Software Development)
        $scores['Software Development'] = $data['q1'] + $data['q2'] + $data['q3'];

        // II. Jaringan dan Infrastruktur
        $scores['Network & Infrastructure'] = $data['q4'] + $data['q5'] + $data['q6'];

        // III. Keamanan Siber
        $scores['Cyber Security'] = $data['q7'] + $data['q8'] + $data['q9'];

        // IV. Analisis Data dan AI
        $scores['Data Analytics & AI'] = $data['q10'] + $data['q11'] + $data['q12'];

        // V. Desain Pengalaman Pengguna (UX/UI)
        $scores['UX/UI Design'] = $data['q13'] + $data['q14'] + $data['q15'];

        return $scores;
    }

    /**
     * Menentukan rekomendasi peminatan berdasarkan skor tertinggi.
     */
    private function getRecommendation(array $scores): string
    {
        // Cari skor tertinggi
        $maxScore = max($scores);
        // Ambil kategori yang memiliki skor tertinggi
        $highInterests = array_keys($scores, $maxScore);
        
        // Gabungkan semua peminatan tertinggi dalam satu string
        if (count($highInterests) > 1) {
            // Jika ada lebih dari satu, pisahkan dengan koma dan "dan" di akhir
            $last = array_pop($highInterests);
            return implode(', ', $highInterests) . ' dan ' . $last;
        }

        return $highInterests[0];
    }

    /**
     * Menampilkan halaman hasil.
     * Anda perlu membuat view peminatan/result.blade.php
     */
    public function showResult(PeminatanResult $result)
    {
        // Untuk menampilkan hasil jika tidak langsung redirect
        $scores = $this->calculateScores($result->toArray());
        $recommendation = $this->getRecommendation($scores);
        return view('result', compact('result', 'scores', 'recommendation'));
    }
}