<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment;
use App\Models\Materi;
use App\Models\Step;
use App\Models\Fase;

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

        // List untuk sidebar
        $segmentsWithCourses = Segment::with('fases.materis')->get();
        // Data pendukung sidebar (Load More)
        $sidebarCourses = Materi::orderBy('created_at', 'desc')->take(3)->get();

        return view('course_detail', [
            'segmentData' => $segment,
            'segmentsWithCourses' => $segmentsWithCourses,
            'sidebarCourses' => $sidebarCourses
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
        $sidebarCourses = Materi::orderBy('created_at', 'desc')->take(3)->get();
        
        return view('materi_detail', [
            'currentMateri' => $currentMateri,
            'fase' => $fase,
            'segmentName' => $segmentName,
            'segmentsWithCourses' => $segmentsWithCourses,
            'sidebarCourses' => $sidebarCourses
        ]);
    }

    /**
     * Menampilkan detail Fase (Mendukung Route fase.show dari hasil pencarian)
     */
    public function showFaseDetail($id)
    {
        $fase = Fase::with('segment')->findOrFail($id);
        
        // Redirect ke halaman segment utama yang mengandung fase ini
        return redirect()->route('course.show', ['segment' => $fase->segment->name])
                         ->with('info', 'Menampilkan materi untuk ' . $fase->title);
    }

    /**
     * Menampilkan halaman ringkasan materi (Redirect dari StepController setelah selesai)
     */
    public function showMateriSummary($materiId)
    {
        $materi = Materi::with('fase.segment', 'steps')->findOrFail($materiId);
        $segmentsWithCourses = Segment::with('fases.materis')->get();
        $sidebarCourses = Materi::orderBy('created_at', 'desc')->take(3)->get();

        return view('materi_summary', [
            'materi' => $materi,
            'segmentsWithCourses' => $segmentsWithCourses,
            'sidebarCourses' => $sidebarCourses,
            'completion_status' => session('success')
        ]);
    }

    /**
     * AJAX Load More Sidebar
     */
    public function loadMoreSidebar(Request $request)
    {
        $page = $request->get('page', 1);

        // Paginate 3 item per klik
        $courses = Materi::orderBy('created_at', 'desc')
                          ->paginate(3, ['*'], 'page', $page);

        // Render partial view (Pastikan file resources/views/partials/sidebar_course_item.blade.php ada)
        $html = view('partials.sidebar_course_item', compact('courses'))->render();

        return response()->json([
            'html' => $html,
            'hasMore' => $courses->hasMorePages()
        ]);
    }
}