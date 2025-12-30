<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminatanController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SegmentController;
use App\Http\Controllers\StepController;
use App\Models\Segment;

/*
|--------------------------------------------------------------------------
| LANDING PAGE & REDIRECTS
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // Jika form peminatan sudah selesai / di-skip, langsung ke segmen
    if (session('form_completed')) {
        return redirect()->route('segments.index');
    }
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| STATIC PAGES
|--------------------------------------------------------------------------
*/
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
| PEMINATAN (SESSION BASED)
|--------------------------------------------------------------------------
*/
Route::get('/peminatan', [PeminatanController::class, 'index'])->name('peminatan.form');
Route::post('/peminatan', [PeminatanController::class, 'store'])->name('peminatan.store');
Route::get('/peminatan/result', [PeminatanController::class, 'showResult'])->name('peminatan.result');

Route::get('/peminatan/skip', function () {
    session(['form_completed' => true]);
    return redirect()->route('segments.index');
})->name('peminatan.skip');

/*
|--------------------------------------------------------------------------
| SEGMENTS & COURSES
|--------------------------------------------------------------------------
*/
Route::get('/segments', [SegmentController::class, 'index'])->name('segments.index');

Route::get('/course/{segment}', [CourseController::class, 'show'])->name('course.show');

Route::get('/materi/{materiId}', [CourseController::class, 'showMateriDetail'])->name('materi.show');

Route::get('/fase/{id}', [CourseController::class, 'showFaseDetail'])->name('fase.show');

/*
|--------------------------------------------------------------------------
| STEP CONTROLLER (Logika Penguncian & Kuis)
|--------------------------------------------------------------------------
*/

// 1. Menampilkan detail langkah
Route::get('/step/{stepId}', [StepController::class, 'show'])->name('step.show');

// 2. Memproses kuis
Route::post('/step/{stepId}/quiz', [StepController::class, 'submitQuiz'])->name('step.submit.quiz');

// 3. Menandai langkah SELESAI (PENTING: Middleware Auth DIHAPUS)
// Method diarahkan ke 'markAsComplete' sesuai controller yang kita update tadi
Route::post('/step/{id}/complete', [StepController::class, 'markAsComplete'])->name('step.complete');

// 4. Menandai materi SELESAI sepenuhnya
Route::post('/step/{stepId}/finish-materi', [StepController::class, 'completeMateri'])->name('materi.complete');

/*
|--------------------------------------------------------------------------
| AJAX & DEV
|--------------------------------------------------------------------------
*/
Route::get('/ajax/load-more-sidebar', [CourseController::class, 'loadMoreSidebar'])->name('ajax.load_more_sidebar');

Route::get('/segment/{id}', function ($id) {
    $segmentData = Segment::with(['fases.materis'])->findOrFail($id);
    return view('course_detail', compact('segmentData'));
})->name('segment.show');