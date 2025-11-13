<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/apply', function () {
    // Fungsi ini akan memuat (return) view yang bernama 'apply'
    return view('apply'); 
});
