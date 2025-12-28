<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment;
use App\Models\Materi;
use App\Models\Fase;
use App\Models\Step;
use Illuminate\Support\Str;

class SegmentController extends Controller
{
    private const CATEGORY_TO_SEGMENT_MAP = [
        'Software Development'      => 'Software Development',
        'Network & Security'        => 'Network & Security',
        'Data Analytics & AI'       => 'Data & AI (Data Science)',
        'UX-UI Design'              => 'UX-UI Design',
    ];

    public function index(Request $request)
    {
        $query = $request->input('query');
        $peminatan = session('peminatan_result');

        $recommendedSegmentNames = [];
        $isFilteredByRecommendation = false;
        $recommendation = null;

        if ($peminatan) {
            $recommendation = $peminatan['recommendation'] ?? null;
            if (!empty($peminatan['matched_categories'])) {
                foreach ($peminatan['matched_categories'] as $category) {
                    if (isset(self::CATEGORY_TO_SEGMENT_MAP[$category])) {
                        $recommendedSegmentNames[] = self::CATEGORY_TO_SEGMENT_MAP[$category];
                    }
                }
            }
            $recommendedSegmentNames = array_unique($recommendedSegmentNames);
            $isFilteredByRecommendation = !empty($recommendedSegmentNames);
        }

        // --- Logika Pencarian & Konten Utama ---
        $segments = collect();
        $fases = collect();
        $materis = collect();
        $steps = collect();

        if ($query) {
            $segments = Segment::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")->get();

            $fases = Fase::where('name', 'like', "%{$query}%")->with('segment')->get();

            $materis = Materi::where('title', 'like', "%{$query}%")
                ->with(['fase.segment'])->get();

            $steps = Step::where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->with(['materi.fase.segment'])->get();
        } elseif ($isFilteredByRecommendation) {
            $segments = Segment::whereIn('name', $recommendedSegmentNames)
                ->with('fases.materis')->latest()->get();
        } else {
            $segments = Segment::with('fases.materis')->latest()->get();
        }

        // --- Logika Sidebar: Ambil dari segment yang TIDAK ada di rekomendasi ---
        $sidebarCoursesQuery = Materi::query();

        if ($isFilteredByRecommendation && !empty($recommendedSegmentNames)) {
            $preferredSegmentIds = Segment::whereIn('name', $recommendedSegmentNames)->pluck('id');
            
            // Ambil materi yang segment-nya BUKAN merupakan rekomendasi
            $sidebarCoursesQuery->whereHas('fase.segment', function ($q) use ($preferredSegmentIds) {
                $q->whereNotIn('segments.id', $preferredSegmentIds);
            });
        }

        $sidebarCourses = $sidebarCoursesQuery
            ->with(['fase.segment'])
            ->inRandomOrder() // Acak agar variatif
            ->take(5)
            ->get();

        return view('segment', compact(
            'segments', 'fases', 'materis', 'steps', 
            'query', 'sidebarCourses', 'isFilteredByRecommendation', 'recommendation'
        ));
    }
}