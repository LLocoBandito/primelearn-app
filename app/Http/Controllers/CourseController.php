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

        // 👉 Perbaikan: tidak ada relasi 'courses'
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

        // 👉 Perbaikan relasi sidebar
        $segmentsWithCourses = Segment::with('fases.materis')->get();
        
        return view('materi_detail', [
            'currentMateri' => $currentMateri,
            'fase' => $fase,
            'segmentName' => $segmentName,
            'segmentsWithCourses' => $segmentsWithCourses
        ]);
    }

    /**
     * Level 4: Halaman detail Step
     */
    public function showStepContent($stepId)
    {
        $step = Step::with('materi.fase.segment')->findOrFail($stepId);

        $materi = $step->materi;
        $fase = $materi->fase;
        $segmentName = $fase->segment->name;

        // 👉 Perbaikan relasi sidebar
        $segmentsWithCourses = Segment::with('fases.materis')->get();
        
        return view('step_detail', [
            'step' => $step,
            'materi' => $materi,
            'fase' => $fase,
            'segmentName' => $segmentName,
            'segmentsWithCourses' => $segmentsWithCourses
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
