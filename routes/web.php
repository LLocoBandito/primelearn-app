<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminatanController;    
use App\Http\Controllers\CourseController;
Route::get('/', function () {
    return view('home');
});

Route::get('/apply', function () {
    // Fungsi ini akan memuat (return) view yang bernama 'apply'
    return view('apply'); 
});
Route::get('/peminatan', [PeminatanController::class, 'index'])->name('peminatan.form');

// Rute untuk memproses pengiriman formulir dan menyimpan ke DB
Route::post('/peminatan', [PeminatanController::class, 'store'])->name('peminatan.store');

Route::get('/course/{segment}', [CourseController::class, 'show'])->name('course.show');
Route::get('/segment', function () {
    // Fungsi ini akan memuat (return) view yang bernama 'apply'
    return view('segment'); 
});
// Route Level 3: Detail Materi/Langkah Pembelajaran
Route::get('/materi/{materiId}', [CourseController::class, 'showMateriDetail'])->name('materi.show');
Route::get('/step/{stepId}', [CourseController::class, 'showStepContent'])->name('step.show');
Route::get('/segment', function () {
    return view('segment');
})->name('segment.index');



