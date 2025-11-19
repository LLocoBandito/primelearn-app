<?php

namespace App\Http\Controllers;

use App\Models\Segment;

class SegmentController extends Controller
{
    public function index()
    {
        $segments = Segment::all();

        return view('segment', [
            'segments' => $segments
        ]);
    }
}
