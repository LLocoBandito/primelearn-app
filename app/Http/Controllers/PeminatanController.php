<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminatanController extends Controller
{
    /**
     * Tampilkan form peminatan (multi-step)
     * Ini juga berfungsi sebagai proses "Retake" atau "Reset".
     */
    public function index()
    {
        // 🎯 LOGIKA PERBAIKAN: Hapus semua data session hasil tes lama
        // Ini memastikan form ditampilkan dari awal (reset)
        session()->forget(['peminatan_result', 'form_completed', 'matched_categories']);

        // Pastikan nama view yang dikembalikan benar (sesuai implementasi Anda)
        return view('apply'); 
    }

    /**
     * Simpan jawaban peminatan dan redirect ke halaman hasil
     */
    public function store(Request $request)
    {
        // 1️⃣ Validasi input
        // Nama input disesuaikan dengan 20 pertanyaan baru yang dikelompokkan
        $validatedData = $request->validate([
            // Software Developer
            'q1_dev' => 'required|integer|between:1,4',
            'q2_dev' => 'required|integer|between:1,4',
            'q3_dev' => 'required|integer|between:1,4',
            'q4_dev' => 'required|integer|between:1,4',
            'q5_dev' => 'required|integer|between:1,4',
            
            // Network & Security
            'q6_net' => 'required|integer|between:1,4',
            'q7_net' => 'required|integer|between:1,4',
            'q8_net' => 'required|integer|between:1,4',
            'q9_net' => 'required|integer|between:1,4',
            'q10_net' => 'required|integer|between:1,4',

            // Data Analytics & AI
            'q11_data' => 'required|integer|between:1,4',
            'q12_data' => 'required|integer|between:1,4',
            'q13_data' => 'required|integer|between:1,4',
            'q14_data' => 'required|integer|between:1,4',
            'q15_data' => 'required|integer|between:1,4',
            
            // UI/UX Design
            'q16_uiux' => 'required|integer|between:1,4',
            'q17_uiux' => 'required|integer|between:1,4',
            'q18_uiux' => 'required|integer|between:1,4',
            'q19_uiux' => 'required|integer|between:1,4',
            'q20_uiux' => 'required|integer|between:1,4',
        ]);

        // 2️⃣ Hitung skor per kategori
        $scores = $this->calculateScores($validatedData);

        // 3️⃣ Tentukan rekomendasi utama
        $recommendation = $this->getRecommendation($scores);

        // 4️⃣ Tentukan match status (strong / less dominant)
        $matchStatus = $this->calculateMatchStatus($scores);

        // 🎯 Ambil hanya nama kategori yang Strong Match (status TRUE)
        $matchedCategories = array_keys(array_filter($matchStatus, fn($isMatch) => $isMatch));

        // 5️⃣ Simpan semua data ke session, termasuk matched_categories
        session([
            'form_completed' => true,
            'peminatan_result' => [
                'answers' => $validatedData,
                'scores' => $scores,
                'recommendation' => $recommendation,
                'matchStatus' => $matchStatus,
                'matched_categories' => $matchedCategories,
            ]
        ]);

        // 6️⃣ Redirect ke halaman hasil
        return redirect()->route('peminatan.result');
    }

    /**
     * Tampilkan hasil peminatan
     */
    public function showResult()
    {
        // Ganti 'peminatan.form' dengan route yang benar jika berbeda
        if (!session()->has('peminatan_result')) {
            return redirect()->route('peminatan.form'); 
        }

        $data = session('peminatan_result');

        // Pastikan nama view yang dikembalikan benar (sesuai implementasi Anda)
        return view('result', [
            'recommendation' => $data['recommendation'],
            'matchStatus' => $data['matchStatus'],
            'scores' => $data['scores'],
        ]);
    }

    /**
     * =========================
     * Helper Methods
     * =========================
     */

    private function calculateScores(array $data): array
    {
        // ALOKASI SKOR BARU (5 pertanyaan per kategori)
        return [
            // Q1, Q2, Q3, Q4, Q5 (DEV)
            'Software Development' => 
                $data['q1_dev'] + $data['q2_dev'] + $data['q3_dev'] + $data['q4_dev'] + $data['q5_dev'],

            // Q6, Q7, Q8, Q9, Q10 (NET)
            'Network & Security' => 
                $data['q6_net'] + $data['q7_net'] + $data['q8_net'] + $data['q9_net'] + $data['q10_net'],

            // Q11, Q12, Q13, Q14, Q15 (DATA)
            'Data Analytics & AI' => 
                $data['q11_data'] + $data['q12_data'] + $data['q13_data'] + $data['q14_data'] + $data['q15_data'],

            // Q16, Q17, Q18, Q19, Q20 (UIUX)
            'UX-UI Design' => 
                $data['q16_uiux'] + $data['q17_uiux'] + $data['q18_uiux'] + $data['q19_uiux'] + $data['q20_uiux'],
        ];
    }
    
    // Metode calculateMatchStatus tidak perlu diubah, karena ia bekerja berdasarkan skor maksimum yang dihitung (Max Score = 20)
    private function calculateMatchStatus(array $scores): array
    {
        $maxScore = max($scores);
        $threshold = $maxScore * 0.7; // 70% dari skor tertinggi

        $matchStatus = [];
        foreach ($scores as $category => $score) {
            $matchStatus[$category] = $score >= $threshold;
        }
        return $matchStatus;
    }

    private function getRecommendation(array $scores): string
    {
        $maxScore = max($scores);
        $topCategories = array_keys($scores, $maxScore);

        if (count($topCategories) > 1) {
            $last = array_pop($topCategories);
            return implode(', ', $topCategories) . ' dan ' . $last;
        }

        return $topCategories[0];
    }
}