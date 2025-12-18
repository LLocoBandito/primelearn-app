<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;
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
            // Asumsi relasi 'steps' di Model Materi sudah diurutkan (orderBy('order'))
            $stepsMateri = $step->materi->steps; 

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
                // Asumsi step memiliki relasi externalLinks ke materi
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
     * TIDAK MEMERLUKAN LOGIN (hanya mengembalikan hasil skor).
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
            
            $score = 0;
            $totalQuestions = count($quizData);

            foreach ($quizData as $index => $quiz) {
                // Ambil kunci jawaban yang benar
                $kunciJawaban = $quiz['correct_answer'] ?? null; 
                // Ambil jawaban dari user berdasarkan index pertanyaan
                $jawabanDiterima = $jawabanUser[$index] ?? null;

                $isCorrect = ($jawabanDiterima && $jawabanDiterima === $kunciJawaban);
                
                if ($isCorrect) {
                    $score++;
                }
            }

            $scorePercentage = $totalQuestions > 0 ? ($score / $totalQuestions) : 0;
            $minPassingScore = 0.8; // Contoh: Minimal skor lulus adalah 80%

            return response()->json([
                'success' => true,
                'score' => $score,
                'total' => $totalQuestions,
                'passed' => $scorePercentage >= $minPassingScore,
                'percentage' => round($scorePercentage * 100),
                'message' => "Anda mendapatkan skor {$score} dari {$totalQuestions}."
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Langkah tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            Log::error("Error submitting quiz for step $stepId: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat memproses kuis.'], 500);
        }
    }

    /**
     * Menandai keseluruhan Materi telah selesai.
     * Metode ini dipanggil dari Langkah TERAKHIR materi.
     * TIDAK MEMERLUKAN LOGIN (hanya mencatat log dan redirect).
     *
     * @param \Illuminate\Http\Request $request
     * @param int $stepId ID dari Step terakhir (trigger)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completeMateri(Request $request, $stepId)
    {
        // Pemeriksaan auth/login DIHAPUS karena situs tidak memerlukan login.
        
        try {
            $step = Step::with('materi')->findOrFail($stepId);
            $materi = $step->materi;
            
            // LOGIKA UTAMA: Melakukan logging atau proses non-user lainnya
            // Jika Anda perlu melacak penyelesaian secara non-user (misal: via session/cookie),
            // Anda dapat mengimplementasikannya di sini.
            
            Log::info("Materi ID: {$materi->id} ({$materi->title}) telah diselesaikan.");
            
            // Redirect ke halaman ringkasan materi atau dashboard
            // Pastikan rute 'materi.summary' ada di routes/web.php Anda
           return redirect()
            ->route('materi.show', ['materiId' => $materi->id]) 
            ->with('success', "Selamat! Anda telah menyelesaikan materi: **{$materi->title}**.");

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Langkah atau Materi tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error("Error completing materi via step $stepId: " . $e->getMessage());
            return back()->with('error', 'Gagal menyelesaikan materi. Silakan coba lagi.');
        }
    }
}