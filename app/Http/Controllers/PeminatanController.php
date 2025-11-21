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
        return view('apply'); // Pastikan path view sesuai
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

        // 2. Simpan Data ke DB
        $result = PeminatanResult::create($validatedData);

        // 3. Hitung Skor
        $scores = $this->calculateScores($validatedData);
        $recommendation = $this->getRecommendation($scores);

        // 4. Set session bahwa user sudah mengisi form
        session(['form_completed' => true]);

        // 5. Tampilkan hasil
        return view('result', compact('result', 'scores', 'recommendation'));
    }

    /**
     * Menghitung total skor per kategori.
     */
    private function calculateScores(array $data): array
    {
        return [
            'Software Development' => $data['q1'] + $data['q2'] + $data['q3'],
            'Network & Infrastructure' => $data['q4'] + $data['q5'] + $data['q6'],
            'Cyber Security' => $data['q7'] + $data['q8'] + $data['q9'],
            'Data Analytics & AI' => $data['q10'] + $data['q11'] + $data['q12'],
            'UX/UI Design' => $data['q13'] + $data['q14'] + $data['q15'],
        ];
    }

    /**
     * Menentukan rekomendasi peminatan berdasarkan skor tertinggi.
     */
    private function getRecommendation(array $scores): string
    {
        $maxScore = max($scores);
        $highInterests = array_keys($scores, $maxScore);

        if (count($highInterests) > 1) {
            $last = array_pop($highInterests);
            return implode(', ', $highInterests) . ' dan ' . $last;
        }

        return $highInterests[0];
    }

    /**
     * Menampilkan halaman hasil.
     */
    public function showResult(PeminatanResult $result)
    {
        $scores = $this->calculateScores($result->toArray());
        $recommendation = $this->getRecommendation($scores);
        return view('result', compact('result', 'scores', 'recommendation'));
    }
}
