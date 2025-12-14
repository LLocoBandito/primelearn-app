<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment;
use App\Models\Materi;
use App\Models\Fase;
use App\Models\Step;

class SegmentController extends Controller
{
    /**
     * Mapping kategori tes → nama segment di database
     * Disusun berdasarkan kategori skor yang ada di PeminatanController
     */
    private const CATEGORY_TO_SEGMENT_MAP = [
        'Software Development'      => 'Software Development',
        'Network & Security'        => 'Network & Security', 
        'Data Analytics & AI'       => 'Data & AI (Data Science)',
        'UX-UI Design'              => 'UX-UI Design',
    ];

    public function index(Request $request)
    {
        $query = $request->input('query');

        /**
         * ===============================
         * 1️⃣ AMBIL DATA PEMINATAN DARI SESSION
         * ===============================
         */
        $peminatan = session('peminatan_result');

        $recommendedSegmentNames = [];
        $isFilteredByRecommendation = false;
        $recommendation = null;

        if ($peminatan) {
            $recommendation = $peminatan['recommendation'] ?? null;

            // Mengambil daftar kategori yang Strong Match dari session
            if (!empty($peminatan['matched_categories'])) {
                foreach ($peminatan['matched_categories'] as $category) {
                    // Menerjemahkan nama kategori tes ke nama segmen database
                    if (isset(self::CATEGORY_TO_SEGMENT_MAP[$category])) {
                        // BARIS INI YANG DIPERBAIKI:
                        $recommendedSegmentNames[] =
                            self::CATEGORY_TO_SEGMENT_MAP[$category];
                        // Perhatikan: Menghapus ekstra 'SEGORY_TO'
                    }
                }
            }
        }

        $recommendedSegmentNames = array_unique($recommendedSegmentNames);

        /**
         * ===============================
         * 2️⃣ QUERY SEGMENT UTAMA
         * ===============================
         */
        $segmentsQuery = Segment::query();

        $segments = collect();
        $fases = collect();
        $steps = collect();

        if ($query) {
            /**
             * 🔍 GLOBAL SEARCH
             */
            $segments = $segmentsQuery
                ->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->get();

            $fases = Fase::where('title', 'like', "%{$query}%")
                ->with('segment')
                ->get();

            $steps = Step::where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })->get();

        } elseif (!empty($recommendedSegmentNames)) {
            /**
             * ⭐ FILTER BERDASARKAN HASIL TES (Hanya yang Strong Match)
             */
            $isFilteredByRecommendation = true;

            $segments = $segmentsQuery
                ->whereIn('name', $recommendedSegmentNames)
                ->latest()
                ->get();

        } else {
            /**
             * 📦 DEFAULT (TANPA TES & TANPA SEARCH)
             */
            $segments = $segmentsQuery
                ->latest()
                ->get();
        }

        /**
         * ===============================
         * 3️⃣ SIDEBAR MATERI (DI LUAR REKOMENDASI)
         * ===============================
         */
        $sidebarCoursesQuery = Materi::query();

        if (!empty($recommendedSegmentNames)) {
            $preferredSegmentIds = Segment::whereIn('name', $recommendedSegmentNames)
                ->pluck('id');

            $sidebarCoursesQuery->whereHas('fase.segment', function ($q) use ($preferredSegmentIds) {
                $q->whereNotIn('segments.id', $preferredSegmentIds);
            });
        }

        $sidebarCourses = $sidebarCoursesQuery
            ->latest()
            ->take(5)
            ->get();

        /**
         * ===============================
         * 4️⃣ KIRIM KE VIEW
         * ===============================
         */
        return view('segment', [
            'segments' => $segments,
            'query' => $query,
            'sidebarCourses' => $sidebarCourses,
            'isFilteredByRecommendation' => $isFilteredByRecommendation,
            'recommendation' => $recommendation,
            'fases' => $fases,
            'steps' => $steps,
        ]);
    }
}