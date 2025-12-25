<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment;
use App\Models\Materi;
use App\Models\Step;

class CourseController extends Controller
{
    public function show($segmentName)
    {
        $segment = Segment::where('name', $segmentName)
            ->with(['fases.materis'])
            ->firstOrFail();

        $segmentsWithCourses = Segment::with('fases.materis')->get();

        return view('course_detail', [
            'segmentData' => $segment,
            'segmentsWithCourses' => $segmentsWithCourses
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
            'segmentName' => $segment->name, // Menambahkan ini agar title di Blade tidak error
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
            'segmentName' => $segment->name, // Menambahkan ini agar title di Blade tidak error
            'segmentsWithCourses' => $segmentsWithCourses
        ]);
    }
}