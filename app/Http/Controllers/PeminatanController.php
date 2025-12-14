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

        return view('apply');
    }

    /**
     * Simpan jawaban peminatan dan redirect ke halaman hasil
     */
    public function store(Request $request)
    {
        // 1️⃣ Validasi input
        $validatedData = $request->validate([
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
            'q16' => 'required|integer|between:1,4',
            'q17' => 'required|integer|between:1,4',
            'q18' => 'required|integer|between:1,4',
            'q19' => 'required|integer|between:1,4',
            'q20' => 'required|integer|between:1,4',
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
        if (!session()->has('peminatan_result')) {
            return redirect()->route('peminatan.form');
        }

        $data = session('peminatan_result');

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
        // Pastikan alokasi skor ini sesuai dengan pertanyaan Anda
        return [
            'Software Development' => 
            $data['q1'] + $data['q7'] + $data['q11'] + ($data['q13'] * 0.5) + $data['q16'] + $data['q20'],

            'Network & Security' => 
                $data['q2'] + $data['q6'] + $data['q10'] + $data['q12'] + $data['q15'] + $data['q18'],

            'UX-UI Design' => 
                $data['q5'] + $data['q8'] + ($data['q13'] * 0.5) + $data['q19'],

            'Data Analytics & AI' => 
                $data['q3'] + $data['q4'] + $data['q9'] + $data['q14'] + $data['q17'],
        ];
    }
    
    // ... (metode calculateMatchStatus dan getRecommendation tidak berubah)
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