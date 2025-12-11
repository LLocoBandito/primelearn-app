<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminatanResult;

class PeminatanController extends Controller
{
    private const MATCH_THRESHOLD = 9; 

    /**
     * Menyimpan data formulir ke database dan mengarahkan ke halaman hasil.
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

        // 2. Hitung Skor & Status
        $scores = $this->calculateScores($validatedData);
        $recommendation = $this->getRecommendation($scores); 
        $matchStatus = $this->calculateMatchStatus($scores); 

        // 3. Ambil kategori yang status kecocokannya TRUE (Centang Hijau)
        $matchedCategories = array_keys(array_filter($matchStatus, function($match) {
            return $match === true;
        }));

        // 4. Tambahkan kategori yang cocok ke data yang akan disimpan (dalam format JSON)
        $dataToStore = array_merge($validatedData, [
            'matched_categories' => json_encode($matchedCategories), // Simpan ke DB
        ]);

        // 5. Simpan Data ke DB
        $result = PeminatanResult::create($dataToStore); 
        
        // 6. Set Session flash (hanya untuk notifikasi yang muncul sekali di halaman hasil/segmen)
        $request->session()->flash('recommendation', $recommendation); 

        // 7. Redirect ke halaman hasil
        return redirect()->route('peminatan.result', ['result' => $result->id]);
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
     * Menentukan status kecocokan (centang hijau) berdasarkan DUA skor tertinggi.
     */
    private function calculateMatchStatus(array $scores): array
    {
        $sortedScores = $scores;
        arsort($sortedScores);

        $topTwo = array_slice($sortedScores, 0, 2, true);
        $minScoreForMatch = 0;
        
        if (!empty($topTwo)) {
             $minScoreForMatch = end($topTwo); 
        }
        
        $matchCategories = [];
        
        foreach ($scores as $category => $score) {
            if ($score >= $minScoreForMatch && $minScoreForMatch > 0) {
                 $matchCategories[$category] = true;
            } else {
                 $matchCategories[$category] = false;
            }
        }
        
        return $matchCategories;
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
        // Data diambil dari DB $result, tetapi perhitungan diulang untuk akurasi
        $dataForCalculation = $result->only([
            'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 
            'q11', 'q12', 'q13', 'q14', 'q15', 'nama'
        ]);

        $scores = $this->calculateScores($dataForCalculation);
        $recommendation = $this->getRecommendation($scores);
        $matchStatus = $this->calculateMatchStatus($scores); 

        return view('result', compact('result', 'scores', 'recommendation', 'matchStatus'));
    }
}