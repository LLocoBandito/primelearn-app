<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminatanResult extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'peminatan_results'; 

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama',
        'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 
        'q10', 'q11', 'q12', 'q13', 'q14', 'q15',
        // --- BARIS BARU ---
        'matched_categories', // Kolom untuk menyimpan array kategori yang cocok (JSON)
    ];
    
    // Opsional: Laravel secara otomatis melakukan casting jika tipe kolom diset ke 'json' di migrasi
    protected $casts = [
        'matched_categories' => 'array', 
    ];
}