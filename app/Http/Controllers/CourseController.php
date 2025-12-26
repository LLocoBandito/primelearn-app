<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment;
use App\Models\Materi;
use App\Models\Step;

class CourseController extends Controller
{
    /**
     * Level 2: Menampilkan detail course (fase dan materi) berdasarkan nama segmen.
     */
    public function show($segmentName)
    {
        // Ambil segment + fases + materis
        $segment = Segment::where('name', $segmentName)
                          ->with(['fases.materis'])
                          ->first();

        if (!$segment) {
            abort(404, 'Segmen pembelajaran tidak ditemukan.');
        }

        // Jika sidebar butuh list segmen saja:
        $segmentsWithCourses = Segment::with('fases.materis')->get();

        return view('course_detail', [
            'segmentData' => $segment,
            'segmentsWithCourses' => $segmentsWithCourses
        ]);
    }
    
    /**
     * Level 3: Halaman detail materi + steps
     */
    public function showMateriDetail($materiId)
    {
        $currentMateri = Materi::with('steps', 'fase.materis', 'fase.segment')
                               ->findOrFail($materiId);

        $fase = $currentMateri->fase;
        $segmentName = $fase->segment->name;

        // Perbaikan relasi sidebar
        $segmentsWithCourses = Segment::with('fases.materis')->get();
        
        return view('materi_detail', [
            'currentMateri' => $currentMateri,
            'fase' => $fase,
            'segmentName' => $segmentName,
            'segmentsWithCourses' => $segmentsWithCourses
        ]);
    }

    // ⭐ METODE BARU: Menampilkan halaman ringkasan materi (Tujuan redirect dari StepController)
    public function showMateriSummary($materiId)
    {
        $materi = Materi::with('fase.segment', 'steps')->findOrFail($materiId);
        
        // Perbaikan relasi sidebar
        $segmentsWithCourses = Segment::with('fases.materis')->get();
        
        // Anda bisa menambahkan logika atau data lain di sini (misalnya, sertifikat, progress, dll.)

        return view('materi_summary', [ // Pastikan Anda memiliki view ini!
            'materi' => $materi,
            'segmentsWithCourses' => $segmentsWithCourses,
            'completion_status' => session('success') // Menerima pesan "Selamat" dari redirect
        ]);
    }

    /**
     * Level 4: Halaman detail Step
     * CATATAN: Metode ini seharusnya dihapus atau diubah namanya
     * karena Anda sudah memindahkannya ke StepController@show.
     * Jika Anda ingin tetap menggunakan CourseController:
     */
    public function showStepContent($stepId)
{
    $step = Step::with([
        'materi.fase.segment',
        'materi.externalLinks',
        'materi.steps'
    ])->findOrFail($stepId);

    $stepsMateri = $step->materi->steps;
    $currentIndex = $stepsMateri->search(fn ($item) => $item->id === $step->id);

    $prevStep = $stepsMateri->get($currentIndex - 1);
    $nextStep = $stepsMateri->get($currentIndex + 1);

    return view('step_detail', [
        'step' => $step,
        'quizData' => $step->quiz_data ?? [],
        'externalLinks' => $step->materi->externalLinks ?? [],
        'prevStep' => $prevStep,
        'nextStep' => $nextStep,
    ]);
}

    /**
     * AJAX Load More Sidebar
     */
    public function loadMoreSidebar(Request $request)
    {
        $page = $request->get('page', 1);

        $courses = Materi::orderBy('created_at', 'desc')
                          ->paginate(3, ['*'], 'page', $page);

        $html = view('partials.sidebar_course_item', compact('courses'))->render();

        return response()->json([
            'html' => $html,
            'hasMore' => $courses->hasMorePages()
        ]);
    }
}