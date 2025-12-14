<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminatanController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SegmentController;
use App\Models\Segment;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // Jika form peminatan sudah selesai / di-skip
    if (session('form_completed')) {
        return redirect()->route('segments.index');
    }
    return view('home');
})->name('home');

/*
|--------------------------------------------------------------------------
| APPLY & STATIC PAGES
|--------------------------------------------------------------------------
*/
Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/apply', function () {
    return view('apply');
})->name('apply.form');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/about', function () {
    return view('about_us');
})->name('about');

/*
|--------------------------------------------------------------------------
| PEMINATAN (SESSION BASED – TANPA DB)
|--------------------------------------------------------------------------
*/
// routes/web.php

Route::get('/apply', function () {
    return view('apply'); // <-- Ini menampilkan apply.blade.php
})->name('apply.form'); // <-- Nama route-nya
Route::get('/peminatan', [PeminatanController::class, 'index'])->name('peminatan.form');
Route::post('/peminatan', [PeminatanController::class, 'store'])->name('peminatan.store');
Route::get('/peminatan/result', [PeminatanController::class, 'showResult'])->name('peminatan.result');

// Skip peminatan
Route::get('/peminatan/skip', function () {
    session(['form_completed' => true]);
    return redirect()->route('segments.index');
})->name('peminatan.skip');

/*
|--------------------------------------------------------------------------
| SEGMENTS & GLOBAL SEARCH
|--------------------------------------------------------------------------
*/
Route::get('/segments', [SegmentController::class, 'index'])
    ->name('segments.index');

/*
|--------------------------------------------------------------------------
| COURSE, MATERI & STEP
|--------------------------------------------------------------------------
*/

// Halaman course per segment
Route::get('/course/{segment}', [CourseController::class, 'show'])
    ->name('course.show');

// Detail materi
Route::get('/materi/{materiId}', [CourseController::class, 'showMateriDetail'])
    ->name('materi.show');

// Detail step
Route::get('/step/{stepId}', [CourseController::class, 'showStepContent'])
    ->name('step.show');

/*
|--------------------------------------------------------------------------
| SEGMENT DETAIL (DEV / OPTIONAL)
|--------------------------------------------------------------------------
| Untuk testing relasi (aman, tidak konflik)
*/
Route::get('/segment/{id}', function ($id) {
    $segmentData = Segment::with(['fases.materis'])->findOrFail($id);
    return view('course_detail', compact('segmentData'));
})->name('segment.show');

/*
|--------------------------------------------------------------------------
| AJAX
|--------------------------------------------------------------------------
*/
Route::get('/ajax/load-more-sidebar', [CourseController::class, 'loadMoreSidebar'])
    ->name('ajax.load_more_sidebar');
