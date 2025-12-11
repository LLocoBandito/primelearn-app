<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment; 
use App\Models\Materi; 
use App\Models\PeminatanResult;
use App\Models\Fase; 
use App\Models\Step; 
use Illuminate\Support\Facades\DB; // Tambahkan ini jika Anda perlu join

class SegmentController extends Controller
{
    private const CATEGORY_TO_SEGMENT_MAP = [
        'Software Development' => 'Software Development',
        'Network & Infrastructure' => 'Jaringan & Infrastruktur', 
        'Cyber Security' => 'Keamanan Siber', 
        'Data Analytics & AI' => 'Data & AI (Data Science)',
        'UX/UI Design' => 'UX/UI Design',
    ];

    public function index(Request $request)
    {
        $query = $request->input('query');
        $segmentsQuery = Segment::query();
        $isFilteredByRecommendation = false;
        
        $latestResult = PeminatanResult::orderBy('created_at', 'desc')->first();
        $recommendation = $request->session()->get('recommendation'); 
        $matchedCategories = null;
        $recommendedSegmentNames = []; // Inisialisasi daftar Segmen yang disukai

        if ($latestResult && $latestResult->matched_categories) {
            $matchedCategories = is_string($latestResult->matched_categories) 
                                 ? json_decode($latestResult->matched_categories, true) 
                                 : $latestResult->matched_categories;
            
            if (!$recommendation) {
                $recommendation = 'Hasil Tes Terakhir Anda';
            }

            // Dapatkan NAMA Segmen yang Direkomendasikan (sama seperti di bagian B)
            if (is_array($matchedCategories)) {
                foreach ($matchedCategories as $categoryName) {
                    if (isset(self::CATEGORY_TO_SEGMENT_MAP[$categoryName])) {
                        $recommendedSegmentNames[] = self::CATEGORY_TO_SEGMENT_MAP[$categoryName];
                    }
                }
            }
            $recommendedSegmentNames = array_unique($recommendedSegmentNames); 
        }
        
        // Inisialisasi variabel hasil pencarian non-Segment
        $fases = collect(); 
        $steps = collect(); 
        $segments = collect();

        if ($query) {
            // A. PENCARIAN GLOBAL AKTIF
            
            // 1. Pencarian di Segment
            $segments = $segmentsQuery
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->get();
            
            // 2. Pencarian di FASE (Pastikan kolom 'name' sudah benar)
            $fases = Fase::where('name', 'like', '%' . $query . '%')
                         ->with('segment') // Eager load segment untuk tampilan di blade
                         ->get();
            
            // 3. Pencarian di STEP
            $steps = Step::where('title', 'like', '%' . $query . '%')
                         ->orWhere('content', 'like', '%' . $query . '%')
                         ->get();

        } elseif ($recommendedSegmentNames) { // Menggunakan $recommendedSegmentNames yang sudah dihitung
            // B. REKOMENDASI AKTIF (Filter Segment)
            $isFilteredByRecommendation = true;
            $segmentsQuery->whereIn('name', $recommendedSegmentNames);
            
            // Eksekusi query Segment untuk kasus rekomendasi
            $segments = $segmentsQuery->orderBy('created_at', 'desc')->get();
            
        } else {
            // C. KASUS DEFAULT (Tampilkan semua Segment)
            $segments = $segmentsQuery->orderBy('created_at', 'desc')->get(); 
        }
        
        // =======================================================
        // KOREKSI UTAMA: LOGIKA SIDEBAR (Materi dari NON-Peminatan)
        // =======================================================
        
        $sidebarCoursesQuery = Materi::query();

        if (!empty($recommendedSegmentNames)) {
            // Jika ada Segmen yang disukai, kita ambil Materi yang BUKAN dari Segmen tersebut.
            
            // 1. Dapatkan ID dari Segmen yang direkomendasikan
            $preferredSegmentIds = Segment::whereIn('name', $recommendedSegmentNames)->pluck('id');
            
            // 2. Query materi yang TIDAK terkait dengan ID Segmen tersebut.
            $sidebarCoursesQuery
                ->whereHas('fase.segment', function ($q) use ($preferredSegmentIds) {
                    $q->whereNotIn('segments.id', $preferredSegmentIds);
                });

        } else {
            // Jika tidak ada data peminatan, tampilkan semua materi terbaru (Default)
            // Query tetap Materi::query()
        }

        $sidebarCourses = $sidebarCoursesQuery
            ->latest() // Urutkan terbaru
            ->take(5)  // Ambil 5 saja
            ->get();
        
        // Kirim semua variabel yang diperlukan ke View
        return view('segment', [ // Pastikan nama view benar: 'segments'
            'segments' => $segments,
            'query' => $query,
            'sidebarCourses' => $sidebarCourses,
            'isFilteredByRecommendation' => $isFilteredByRecommendation,
            'recommendation' => $recommendation, 
            'fases' => $fases, 
            'steps' => $steps,
        ]);
    }

    // Pastikan Anda memiliki relasi Fase->segment dan Materi->fase di Model Anda
}