<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminatanController;    

Route::get('/', function () {
    return view('home'); // Memuat resources/views/home.blade.php
})->name('home'); 


Route::get('/apply', function () {
    // Fungsi ini akan memuat (return) view yang bernama 'apply'
    return view('apply'); 
})->name('apply');;
Route::get('/peminatan', [PeminatanController::class, 'index'])->name('peminatan.form');

// Rute untuk memproses pengiriman formulir dan menyimpan ke DB
Route::post('/peminatan', [PeminatanController::class, 'store'])->name('peminatan.store');


Route::get('/segment', function () {
    return view('segment');
})->name('segment.index');

Route::get('/about-us', function () {
    // Memuat resources/views/aboutus.blade.php
    return view('aboutus'); 
})->name('aboutus');

Route::get('/faq', function () {
    // Memuat resources/views/faq.blade.php
    return view('faq'); 
})->name('faq');



