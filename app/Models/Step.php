<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id',
        'order',
        'title',
        'content',
        'video_url',    // <-- BARU: Untuk URL embed video (String)
        'quiz_data',    // <-- BARU: Untuk data kuis terstruktur (JSON/Array)
        'total_steps',  // <-- BARU: Untuk jumlah langkah dalam materi (Integer)
        // 'image_path' telah dihapus (sudah benar)
    ];

    /**
     * Casting kolom ke tipe data spesifik.
     * Kita menggunakan 'array' agar Laravel otomatis mengkonversi JSON dari database
     * menjadi array PHP saat diakses ($step->quiz_data).
     */
    protected $casts = [
        'quiz_data' => 'array',
        'is_interactive' => 'boolean',
    ];


    /**
     * Relasi ke model Materi (Parent)
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    /**
     * Relasi ke banyak gambar
     */
    public function images()
    {
        return $this->hasMany(StepImage::class);
    }

    /**
     * Mengambil gambar pertama (opsional untuk thumbnail)
     */
    public function firstImage()
    {
        return $this->hasOne(StepImage::class)->oldest();
    }
}