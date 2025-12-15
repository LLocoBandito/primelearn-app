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
        'video_url', // Pastikan ini ada jika Anda menambahkannya di Filament
        'quiz_data',
        'external_links',
        // HAPUS 'image_path' karena sekarang gambar disimpan di tabel step_images
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

    protected $casts = [
        'quiz_data' => 'array',
        'external_links' => 'array', // PENTING: Untuk kemudahan akses data kuis
    ];
}
