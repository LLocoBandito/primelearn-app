<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StepController extends Controller
{
    /**
     * Menampilkan detail Step/Langkah pembelajaran.
     * Logika: Mengecek apakah langkah sebelumnya sudah ada di session.
     */
    public function show($stepId)
    {
        try {
            // 1. Ambil Step dan relasinya
            $step = Step::with([
                'materi.fase.segment',
                'materi.steps'
            ])->findOrFail($stepId);

            // 2. Tentukan Step Sebelumnya dan Selanjutnya (Urut berdasarkan 'order')
            $stepsMateri = $step->materi->steps->sortBy('order');

            $currentIndex = $stepsMateri->values()->search(fn($item) => $item->id === $step->id);

            $prevStep = $stepsMateri->values()->get($currentIndex - 1);
            $nextStep = $stepsMateri->values()->get($currentIndex + 1);

            // --- LOGIKA PENGUNCIAN ---
            $completedSteps = session()->get('completed_steps', []);
            $isLocked = false;

            // Terkunci jika ada langkah sebelumnya tapi belum diselesaikan (tidak ada di session)
            if ($prevStep && !in_array($prevStep->id, $completedSteps)) {
                $isLocked = true;
            }

            // Data yang dikirim ke view
            return view('step_detail', [
                'step' => $step,
                'quizData' => $step->quiz_data,
                'externalLinks' => $step->materi->externalLinks ?? [],
                'prevStep' => $prevStep,
                'nextStep' => $nextStep,
                'isLocked' => $isLocked,
                'completedSteps' => $completedSteps
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Langkah pembelajaran tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error("Error loading step $stepId: " . $e->getMessage());
            abort(500, 'Terjadi kesalahan pada server.');
        }
    }

    /**
     * MENCATAT LANGKAH SEBAGAI SELESAI
     * Diperbaiki: Nama route redirect disesuaikan dengan web.php (step.show)
     */
    public function markAsComplete(Request $request, $stepId)
    {
        // 1. Simpan ID langkah ke session
        $completedSteps = session()->get('completed_steps', []);

        if (!in_array($stepId, $completedSteps)) {
            $completedSteps[] = (int) $stepId;
            session()->put('completed_steps', $completedSteps);
        }

        // 2. Jika ada instruksi lanjut ke langkah berikutnya
        if ($request->has('next_step_id')) {
            // DIUBAH: Menggunakan 'step.show' sesuai web.php Anda
            return redirect()->route('step.show', ['stepId' => $request->next_step_id]);
        }

        // 3. Jika tidak ada langkah berikutnya, kembali ke halaman materi detail
        $step = Step::find($stepId);
        if ($step) {
            return redirect()->route('materi.show', ['materiId' => $step->materi_id])
                ->with('success', 'Langkah berhasil diselesaikan!');
        }

        return back()->with('success', 'Langkah diselesaikan!');
    }

    /**
     * Logika untuk memproses kuis
     * Otomatis simpan ke session jika lulus (80%)
     */
    public function submitQuiz(Request $request, $stepId)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);

        try {
            $step = Step::findOrFail($stepId);
            $jawabanUser = $request->input('answers');
            $quizData = $step->quiz_data;

            $score = 0;
            $totalQuestions = count($quizData);

            foreach ($quizData as $index => $quiz) {
                $kunciJawaban = $quiz['correct_answer'] ?? null;
                $jawabanDiterima = $jawabanUser[$index] ?? null;
                if ($jawabanDiterima && $jawabanDiterima === $kunciJawaban) {
                    $score++;
                }
            }

            $scorePercentage = $totalQuestions > 0 ? ($score / $totalQuestions) : 0;
            $minPassingScore = 0.8;
            $passed = $scorePercentage >= $minPassingScore;

            // Simpan progress secara otomatis jika lulus kuis
            if ($passed) {
                $completedSteps = session()->get('completed_steps', []);
                if (!in_array($stepId, $completedSteps)) {
                    $completedSteps[] = (int) $stepId;
                    session()->put('completed_steps', $completedSteps);
                }
            }

            return response()->json([
                'success' => true,
                'score' => $score,
                'total' => $totalQuestions,
                'passed' => $passed,
                'percentage' => round($scorePercentage * 100),
                'message' => "Anda mendapatkan skor {$score} dari {$totalQuestions}."
            ]);

        } catch (\Exception $e) {
            Log::error("Error submitting quiz: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan.'], 500);
        }
    }

    /**
     * Menandai keseluruhan Materi telah selesai.
     */
    public function completeMateri(Request $request, $stepId)
    {
        try {
            $step = Step::with('materi')->findOrFail($stepId);
            $materi = $step->materi;

            // Tambahkan langkah terakhir ini ke session sebelum dianggap selesai
            $completedSteps = session()->get('completed_steps', []);
            if (!in_array($stepId, $completedSteps)) {
                $completedSteps[] = (int) $stepId;
                session()->put('completed_steps', $completedSteps);
            }

            Log::info("Materi ID: {$materi->id} ({$materi->title}) telah diselesaikan.");

            return redirect()
                ->route('materi.show', ['materiId' => $materi->id])
                ->with('success', "Selamat! Anda telah menyelesaikan materi: **{$materi->title}**.");

        } catch (\Exception $e) {
            Log::error("Error completing materi: " . $e->getMessage());
            return back()->with('error', 'Gagal menyelesaikan materi.');
        }
    }
}