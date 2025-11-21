<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminatanController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SegmentController;
use App\Models\Segment;

// Landing Page
Route::get('/', function () {
    if (session('form_completed')) {
        return redirect()->route('segments.index');
    }
    return view('home');
});

// Apply form

Route::get('/apply', function () {
    return view('apply');
});

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

Route::get('/sidebar-courses/load-more', [CourseController::class, 'loadMoreSidebar'])
    ->name('sidebar.loadMore');

Route::get('/ajax/load-more-sidebar', [App\Http\Controllers\CourseController::class, 'loadMoreSidebar'])->name('ajax.load_more_sidebar');
