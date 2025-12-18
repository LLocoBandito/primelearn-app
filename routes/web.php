<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminatanController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SegmentController;
use App\Http\Controllers\StepController; // <-- Pastikan ini diimpor
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
// Rute Home ganda, salah satunya bisa dihapus, tapi jika Anda ingin tetap ada:
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
| COURSE & MATERI
|--------------------------------------------------------------------------
*/

// Halaman course per segment
Route::get('/course/{segment}', [CourseController::class, 'show'])
    ->name('course.show');

// Detail materi (Digunakan untuk link di halaman daftar materi)
Route::get('/materi/{materiId}', [CourseController::class, 'showMateriDetail'])
    ->name('materi.show');


/*
|--------------------------------------------------------------------------
| STEP CONTROLLER (Langkah Pembelajaran, Kuis, dan Penyelesaian Materi)
|--------------------------------------------------------------------------
*/

// 1. Detail step (Menggantikan rute CourseController::showStepContent)
Route::get('/step/{stepId}', [StepController::class, 'show'])
    ->name('step.show');

// 2. Endpoint POST untuk memproses pengiriman kuis (interaktif)
Route::post('/step/{stepId}/quiz', [StepController::class, 'submitQuiz'])
    ->name('step.submit.quiz'); // Diperbaiki penamaan dari step.submit_quiz ke step.submit.quiz

// 3. Endpoint POST untuk menyelesaikan materi (dipanggil dari langkah terakhir)
Route::post('/step/{stepId}/complete', [StepController::class, 'completeMateri'])
    ->name('materi.complete'); 


/*
|--------------------------------------------------------------------------
| SEGMENT DETAIL (DEV / OPTIONAL)
|--------------------------------------------------------------------------
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