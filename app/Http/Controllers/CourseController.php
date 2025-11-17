<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment;
use App\Models\Materi;
use App\Models\Step; // Penting: Import Model Step

class CourseController extends Controller
{
    /**
     * Level 2: Menampilkan detail course (fase dan materi) berdasarkan nama segmen.
     * Menggunakan eager loading Segment -> Fases -> Materis.
     * @param string $segmentName
     * @return \Illuminate\View\View
     */
    public function show($segmentName)
    {
        // Eager loading untuk Level 2: Segment -> Fases -> Materis
        $segment = Segment::where('name', $segmentName)
                          ->with(['fases.materis'])
                          ->first();

        if (!$segment) {
            abort(404, 'Segmen pembelajaran tidak ditemukan.');
        }

        return view('course_detail', [
            'segmentData' => $segment, 
        ]);
    }
    
    /**
     * Level 3: Menampilkan detail spesifik dari satu materi, termasuk langkah-langkahnya.
     * Menggunakan eager loading Materi -> Steps, Fase -> Materis, Fase -> Segment.
     * @param int $materiId
     * @return \Illuminate\View\View
     */
    public function showMateriDetail($materiId)
    {
        // Eager loading untuk Level 3: Materi -> Steps, Fase -> Materis, Fase -> Segment
        $currentMateri = Materi::with('steps', 'fase.materis', 'fase.segment')->findOrFail($materiId);
        
        $fase = $currentMateri->fase;
        
        // Ambil nama segmen untuk Breadcrumb
        $segmentName = $fase->segment->name; 
        
        return view('materi_detail', [
            'currentMateri' => $currentMateri,  // Materi yang sedang dilihat (dengan steps)
            'fase' => $fase,                    // Fase yang menaungi (untuk Sidebar)
            'segmentName' => $segmentName,      // Nama segmen untuk navigasi Breadcrumb
        ]);
    }

    /**
     * Level 4: Menampilkan konten mendalam dari satu langkah (Step) spesifik (Halaman Blog).
     * Menggunakan eager loading Step -> Materi -> Fase -> Segment.
     * @param int $stepId
     * @return \Illuminate\View\View
     */
    public function showStepContent($stepId)
    {
        // Eager load Step, dan ambil relasi Materi -> Fase -> Segment untuk breadcrumb/sidebar
        $step = Step::with('materi.fase.segment')->findOrFail($stepId);

        // Ambil data untuk kemudahan akses di view
        $materi = $step->materi;
        $fase = $materi->fase;
        $segmentName = $fase->segment->name;
        
        return view('step_detail', [
            'step' => $step,                // Data Step yang sedang dilihat
            'materi' => $materi,            // Data Materi yang menaungi
            'fase' => $fase,                // Data Fase yang menaungi
            'segmentName' => $segmentName,  // Nama Segmen untuk Breadcrumb
        ]);
    }
}