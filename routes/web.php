<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminatanController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SegmentController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\MateriController;  
use App\Models\Segment;
use app\models\Materi;

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
// 🎯 PENAMBAHAN ROUTE UNTUK FASE (Diasumsikan ditangani CourseController)
Route::get('/fase/{faseId}', [CourseController::class, 'showFaseDetail'])
    ->name('fase.show'); // <-- Nama route yang dicari
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

/* steps */
Route::get('/materi/{materi}/step/{order}', [StepController::class, 'show'])
    ->name('steps.show');

// Route untuk menyelesaikan materi (juga dibutuhkan di navigasi)
Route::get('/materi/{materi}/complete', function() {
    // Logika penyelesaian materi
    return redirect('/')->with('success', 'Materi selesai!');
})->name('materi.complete');

Route::get('/materi/{materi}/step/{order}', [StepController::class, 'show']) // Panggil StepController
    ->name('steps.show');

    /* Rute untuk Menampilkan Detail Materi (Setelah Selesai Step) */
/* Rute Langkah-Langkah yang sudah Anda miliki */
Route::get('/materi/{materi}/step/{order}', [StepController::class, 'show'])
    ->name('steps.show');

/* Rute Langkah-Langkah (Sudah Benar) */
Route::get('/materi/{materi}/step/{order}', [StepController::class, 'show'])
    ->name('steps.show');

    Route::get('/materi/{materi}', function (Materi $materi) {
    // Memuat relasi steps, externalLinks, dll.
    $materi->load(['steps', 'externalLinks', 'fase']); 
    
    // Tampilkan view materi_detail yang sudah ada
    return view('materi_detail', [
        'materi' => $materi
    ]);
})->name('materi.show'); 