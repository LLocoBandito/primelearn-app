<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminatanController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SegmentController;
use App\Http\Controllers\SearchController; 
use App\Models\Segment;

// LANDING PAGE (Root Path)
Route::get('/', function () {
    // Jika form sudah selesai (atau dilewati), redirect ke halaman Segments.
    if (session('form_completed')) {
        return redirect()->route('segments.index');
    }
    return view('home');
})->name('home'); 

// Apply form
Route::get('/apply', function () {
    return view('apply');
})->name('apply.form');

// FAQ
Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// PEMINATAN
Route::get('/peminatan', [PeminatanController::class, 'index'])->name('peminatan.form');
Route::post('/peminatan', [PeminatanController::class, 'store'])->name('peminatan.store');
Route::get('/peminatan/result/{result}', [PeminatanController::class, 'showResult'])->name('peminatan.result');
Route::get('/peminatan/skip', function () {
    session(['form_completed' => true]);
    return redirect()->route('segments.index');
})->name('peminatan.skip');


// SEGMENTS & GLOBAL SEARCH
Route::get('/segments', [SegmentController::class, 'index'])->name('segments.index');

// COURSE & SEGMENT VIEW DETAIL
Route::get('/course/{segment}', [CourseController::class, 'show'])->name('course.show');

// =======================================================================
// KOREKSI UTAMA: Mengembalikan rute detail materi yang hilang
// =======================================================================

// MATERI & STEP DETAIL
Route::get('/materi/{materiId}', [CourseController::class, 'showMateriDetail'])->name('materi.show'); // <-- RUTE YANG HILANG!

Route::get('/step/{stepId}', [CourseController::class, 'showStepContent'])->name('step.show');


// Segment detail with relationship (Tidak ada masalah jika ini hanya untuk development/testing)
Route::get('/segment/{id}', function ($id) {
    $segmentData = Segment::with(['fases.materis'])->findOrFail($id);
    return view('course_detail', compact('segmentData'));
})->name('segment.show');

// ABOUT US
Route::get('/about', function () {
    return view('about_us');
})->name('about');

// AJAX FOR SIDEBAR
Route::get('/ajax/load-more-sidebar', [App\Http\Controllers\CourseController::class, 'loadMoreSidebar'])->name('ajax.load_more_sidebar');