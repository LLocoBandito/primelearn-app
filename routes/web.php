<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminatanController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SegmentController;

Route::get('/', function () {
    return view('home');
});

Route::get('/apply', function () {
    return view('apply');
});

// Peminatan
Route::get('/peminatan', [PeminatanController::class, 'index'])->name('peminatan.form');
Route::post('/peminatan', [PeminatanController::class, 'store'])->name('peminatan.store');

// Segments
Route::get('/segments', [SegmentController::class, 'index'])->name('segments.index');

// Course
Route::get('/course/{segment}', [CourseController::class, 'show'])->name('course.show');

// Detail materi & step
Route::get('/materi/{materiId}', [CourseController::class, 'showMateriDetail'])->name('materi.show');
Route::get('/step/{stepId}', [CourseController::class, 'showStepContent'])->name('step.show');
