<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
    
    // Pastikan semua kolom yang diisi oleh seeder ada di sini
    protected $fillable = [
        'materi_id',
        'order',
        'title',
        'content',
        'image_path',
    ];

    // Definisikan relasi ke Materi (Parent)
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}