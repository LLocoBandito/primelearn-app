<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StepController extends Controller
{
    /**
     * Menampilkan detail Step/Langkah pembelajaran, termasuk video dan kuis.
     * Mengambil konteks navigasi (prevStep dan nextStep).
     *
     * @param int $stepId ID dari Step yang ingin ditampilkan
     * @return \Illuminate\View\View
     */
    public function show($stepId)
    {
        try {
            // 1. Ambil Step dan seluruh relasi ke atas (Materi, Fase, Segment)
            // Serta eager load semua step dalam materi untuk navigasi
            $step = Step::with([
                'materi.fase.segment',
                'materi.externalLinks',
                'materi.steps' 
            ])->findOrFail($stepId);

            // 2. Tentukan Step Sebelumnya dan Selanjutnya (berdasarkan kolom 'order' di tabel steps)
            $stepsMateri = $step->materi->steps; // Collection of steps, sudah diurutkan di Model Materi

            // Cari index step saat ini di dalam collection
            $currentIndex = $stepsMateri->search(fn ($item) => $item->id === $step->id);

            // Ambil step sebelum dan sesudah
            $prevStep = $stepsMateri->get($currentIndex - 1);
            $nextStep = $stepsMateri->get($currentIndex + 1);

            // Data yang dikirim ke view
            return view('step_detail', [
                'step' => $step,
                // quizData sudah otomatis menjadi array karena $casts di Model Step
                'quizData' => $step->quiz_data, 
                'externalLinks' => $step->materi->externalLinks,
                'prevStep' => $prevStep,
                'nextStep' => $nextStep,
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Tangani jika ID Step tidak ditemukan
            abort(404, 'Langkah pembelajaran tidak ditemukan.');
        } catch (\Exception $e) {
            // Log error lainnya
            Log::error("Error loading step $stepId: " . $e->getMessage());
            abort(500, 'Terjadi kesalahan pada server.');
        }
    }

    /**
     * Logika untuk memproses dan memeriksa jawaban kuis (AJAX endpoint).
     *
     * @param \Illuminate\Http\Request $request
     * @param int $stepId
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitQuiz(Request $request, $stepId)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);

        try {
            $step = Step::findOrFail($stepId);
            $jawabanUser = $request->input('answers');
            $quizData = $step->quiz_data; // Sudah berbentuk array/object karena Model casting
            
            // Asumsi structure quizData:
            // [
            //     ['question' => '...', 'options' => ['A', 'B', 'C'], 'correct_answer' => 'B'],
            //     ...
            // ]

            $score = 0;
            $totalQuestions = count($quizData);
            $results = [];

            foreach ($quizData as $index => $quiz) {
                // Ambil kunci jawaban yang benar
                $kunciJawaban = $quiz['correct_answer'] ?? null; 
                // Ambil jawaban dari user berdasarkan index pertanyaan
                $jawabanDiterima = $jawabanUser[$index] ?? null;

                $isCorrect = ($jawabanDiterima && $jawabanDiterima === $kunciJawaban);
                
                if ($isCorrect) {
                    $score++;
                }
                
                $results[] = [
                    'question_index' => $index,
                    'is_correct' => $isCorrect,
                    'user_answer' => $jawabanDiterima,
                    'correct_answer' => $kunciJawaban,
                ];
            }

            $scorePercentage = $totalQuestions > 0 ? ($score / $totalQuestions) : 0;
            $minPassingScore = 0.8; // Contoh: Minimal skor lulus adalah 80%

            return response()->json([
                'success' => true,
                'score' => $score,
                'total' => $totalQuestions,
                'passed' => $scorePercentage >= $minPassingScore,
                'percentage' => round($scorePercentage * 100),
                'results' => $results,
                'message' => "Anda mendapatkan skor {$score} dari {$totalQuestions}."
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Langkah tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            Log::error("Error submitting quiz for step $stepId: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat memproses kuis.'], 500);
        }
    }
}