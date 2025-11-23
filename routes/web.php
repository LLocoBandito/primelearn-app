<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminatanController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SegmentController;
use App\Models\Segment;
use App\Models\Materi; 


// Landing Page
Route::get('/', function () {
    if (session('form_completed')) {
        return redirect()->route('segments.index');
    }

    // ⬅ SOLUSI A — Tambahkan $sidebarCourses
    $sidebarCourses = Materi::latest()->take(5)->get();

    // ⬅ Ambil segment jika halamannya pakai segment.blade.php
    $segments = Segment::all();

    return view('segment', compact('segments', 'sidebarCourses'));
})->name('home');


// Apply form

Route::get('/apply', function () {
    return view('apply');
});

Route::get('/faq', function () {
    return view('faq');
})-> name('faq');

// Peminatan
Route::get('/peminatan', [PeminatanController::class, 'index'])->name('peminatan.form');
Route::post('/peminatan', [PeminatanController::class, 'store'])->name('peminatan.store');

// Segments
Route::get('/segments', [SegmentController::class, 'index'])->name('segments.index');
Route::get('/materi/{materi}', [App\Http\Controllers\CourseController::class, 'showMateriDetail'])->name('materi.detail');

// Course
Route::get('/course/{segment}', [CourseController::class, 'show'])->name('course.show');

// Detail materi & step
Route::get('/materi/{materiId}', [CourseController::class, 'showMateriDetail'])->name('materi.show');
Route::get('/step/{stepId}', [CourseController::class, 'showStepContent'])->name('step.show');

// Segment detail with relationship
Route::get('/segment/{id}', function ($id) {
    $segmentData = Segment::with(['fases.materis'])->findOrFail($id);
    return view('course_detail', compact('segmentData'));
})->name('segment.show');

Route::get('/about', function () {
    // Fungsi 'view()' akan mencari file resources/views/about.blade.php
    return view('about_us');
})->name('about');

Route::get('/sidebar-courses/load-more', [CourseController::class, 'loadMoreSidebar'])
    ->name('sidebar.loadMore');

Route::get('/ajax/load-more-sidebar', [App\Http\Controllers\CourseController::class, 'loadMoreSidebar'])->name('ajax.load_more_sidebar');
