<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminatanController;    
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

