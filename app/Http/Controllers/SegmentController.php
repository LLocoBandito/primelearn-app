<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment;
use App\Models\Materi;

class SegmentController extends Controller
{
    /**
     * Menampilkan daftar segmen + sidebar materi terbaru.
     */
    public function index(Request $request)
    {
        // ─────────────────────────────────────────────
        // 1. Pencarian Segment
        // ─────────────────────────────────────────────
        $query = $request->input('query');

        $segmentsQuery = Segment::query();

        if ($query) {
            $segmentsQuery
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%');
        }

        $segments = $segmentsQuery->orderBy('created_at', 'desc')->get();


        // ─────────────────────────────────────────────
        // 2. Data Sidebar – Materi Terbaru
        // ─────────────────────────────────────────────
        $sidebarCourses = Materi::orderBy('created_at', 'desc')
                                 ->take(3)
                                 ->get();


        // ─────────────────────────────────────────────
        // 3. Kirim ke View
        // ─────────────────────────────────────────────
        return view('segment', [
            'segments' => $segments,
            'query' => $query,
            'sidebarCourses' => $sidebarCourses,
        ]);
    }
}
