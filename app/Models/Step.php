<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; // Tambahan untuk deteksi user
use Illuminate\Support\Facades\DB;   // Tambahan untuk cek progress di database

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

    /**
     * --- LOGIKA TAMBAHAN: CEK STATUS UNLOCK ---
     * Fungsi ini mengecek apakah langkah saat ini sudah boleh diakses atau belum.
     */
    public function isUnlocked()
    {
        $user = Auth::user();

        // Jika user belum login, kunci semua akses
        if (!$user) {
            return false;
        }

        // 1. Ambil langkah pertama dalam materi ini berdasarkan urutan 'order' terkecil
        $firstStep = self::where('materi_id', $this->materi_id)
            ->orderBy('order', 'asc')
            ->first();

        // 2. Jika langkah ini adalah langkah pertama, otomatis terbuka (True)
        if ($this->id === $firstStep->id) {
            return true;
        }

        // 3. Cari langkah tepat satu tingkat di bawah urutan langkah ini
        $previousStep = self::where('materi_id', $this->materi_id)
            ->where('order', '<', $this->order)
            ->orderBy('order', 'desc')
            ->first();

        // Jika karena alasan tertentu data order rusak dan tidak ada langkah sebelumnya, anggap terbuka
        if (!$previousStep) {
            return true;
        }

        // 4. Cek apakah user sudah menyelesaikan langkah sebelumnya tersebut di tabel 'user_progress'
        return DB::table('user_progress')
            ->where('user_id', $user->id)
            ->where('step_id', $previousStep->id)
            ->exists();
    }
}