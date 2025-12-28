<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment;
use App\Models\Materi;
use App\Models\Step;
use App\Models\Fase;
use Illuminate\Support\Str; // Tambahkan ini untuk fungsi limit teks

class CourseController extends Controller
{
    public function show($segmentName)
    {
        $segment = Segment::where('name', $segmentName)
            ->with(['fases.materis'])
            ->firstOrFail();

        $segmentsWithCourses = Segment::with('fases.materis')->get();
        
        // Data pendukung sidebar awal (Ambil 3 terbaru)
        $sidebarCourses = Materi::orderBy('created_at', 'desc')->paginate(3);

        return view('course_detail', [
            'segmentData' => $segment,
            'segmentsWithCourses' => $segmentsWithCourses,
            'sidebarCourses' => $sidebarCourses,
            'query' => null // Tambahkan default agar tidak error di blade
        ]);
    }

    public function showMateriDetail($materiId)
    {
        $currentMateri = Materi::with(['steps', 'fase.materis', 'fase.segment'])
            ->findOrFail($materiId);

        $fase = $currentMateri->fase;
        $segment = $fase->segment;

        $segmentsWithCourses = Segment::with('fases.materis')->get();

        return view('materi_detail', [
            'currentMateri' => $currentMateri,
            'fase' => $fase,
            'segment' => $segment,
            'segmentName' => $segment->name,
            'segmentsWithCourses' => $segmentsWithCourses
        ]);
    }

    public function showStepContent($stepId)
    {
        $step = Step::with('materi.fase.segment')->findOrFail($stepId);

        $materi = $step->materi;
        $fase = $materi->fase;
        $segment = $fase->segment;

        $segmentsWithCourses = Segment::with('fases.materis')->get();

        return view('step_detail', [
            'step' => $step,
            'materi' => $materi,
            'fase' => $fase,
            'segment' => $segment,
            'segmentName' => $segment->name,
            'segmentsWithCourses' => $segmentsWithCourses
        ]);
    }

    /**
     * FUNGSI BARU: Menangani request AJAX untuk Load More Sidebar
     */
    public function loadMoreSidebar(Request $request)
    {
        // Mengambil materi dengan pagination (3 data per halaman)
        // Laravel otomatis mendeteksi parameter ?page dari JavaScript
        $sidebarCourses = Materi::orderBy('created_at', 'desc')->paginate(3);

        $html = '';
        foreach ($sidebarCourses as $course) {
            // Kita susun HTML yang sama persis dengan yang ada di sidebar blade Anda
            $description = Str::limit($course->description, 50);
            $url = route('materi.show', $course->id);

            $html .= '
            <div class="small-post-item">
                <div class="small-post-text">
                    <a href="' . $url . '">
                        <p><strong>' . e($course->title) . '</strong></p>
                    </a>
                    <small>' . e($description) . '</small>
                </div>
            </div>';
        }

        return response()->json([
            'html' => $html,
            'hasMore' => $sidebarCourses->hasMorePages()
        ]);
    }
}