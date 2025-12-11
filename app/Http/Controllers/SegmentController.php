<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment; 
use App\Models\Materi;  
use App\Models\PeminatanResult; // <-- PENTING: Gunakan Model PeminatanResult

class SegmentController extends Controller
{
    // Array pemetaan dari nama Kategori (di PeminatanController) ke nama Segment (di DB)
    private const CATEGORY_TO_SEGMENT_MAP = [
        'Software Development' => 'Software Development',
        'Network & Infrastructure' => 'Jaringan & Infrastruktur', 
        'Cyber Security' => 'Keamanan Siber', 
        'Data Analytics & AI' => 'Data & AI (Data Science)',
        'UX/UI Design' => 'UX/UI Design',
    ];

    /**
     * Menampilkan daftar segmen yang difilter (berdasarkan hasil tes terbaru) atau dicari.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $segmentsQuery = Segment::query();
        $isFilteredByRecommendation = false;
        
        // Ambil hasil tes terbaru dari database
        $latestResult = PeminatanResult::orderBy('created_at', 'desc')->first();
        
        // Ambil string rekomendasi dari session flash (hanya untuk notifikasi yang muncul saat redirect)
        $recommendation = $request->session()->get('recommendation'); 

        // Tentukan kategori yang cocok (centang hijau) dari DB
        $matchedCategories = null;

        if ($latestResult && $latestResult->matched_categories) {
            // Jika kolom di-cast ke 'array' di model, ini akan menjadi array. Jika tidak, decode JSON manual.
            $matchedCategories = is_string($latestResult->matched_categories) 
                                 ? json_decode($latestResult->matched_categories, true) 
                                 : $latestResult->matched_categories;
            
            // Jika recommendation dari sesi sudah hilang, kita gunakan pesan fallback
            if (!$recommendation) {
                $recommendation = 'Hasil Tes Terakhir Anda';
            }
        }


        if ($query) {
            // A. PENCARIAN AKTIF
            $segmentsQuery
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%');
            
        } elseif ($matchedCategories && is_array($matchedCategories)) {
            // B. REKOMENDASI AKTIF (Filter Permanen dari DB)
            $isFilteredByRecommendation = true;
            $recommendedSegmentNames = [];
            
            // 2. TERJEMAHKAN NAMA KATEGORI YANG COCOK KE NAMA SEGMENT DI DB
            foreach ($matchedCategories as $categoryName) {
                if (isset(self::CATEGORY_TO_SEGMENT_MAP[$categoryName])) {
                    $recommendedSegmentNames[] = self::CATEGORY_TO_SEGMENT_MAP[$categoryName];
                }
            }
            
            // 3. Terapkan filter whereIn
            $recommendedSegmentNames = array_unique($recommendedSegmentNames); 
            $segmentsQuery->whereIn('name', $recommendedSegmentNames);

        }
        
        // Eksekusi query
        $segments = $segmentsQuery->orderBy('created_at', 'desc')->get(); 
        
        // Data Sidebar – Materi Terbaru
        $sidebarCourses = Materi::orderBy('created_at', 'desc')
                                 ->take(3)
                                 ->get();
        
        // Kirim ke View
        return view('segment', [
            'segments' => $segments,
            'query' => $query,
            'sidebarCourses' => $sidebarCourses,
            'isFilteredByRecommendation' => $isFilteredByRecommendation,
            'recommendation' => $recommendation, 
        ]);
    }
}