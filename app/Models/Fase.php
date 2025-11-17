<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fase extends Model
{
    use HasFactory;

    /**
     * Tentukan kolom yang dapat diisi secara massal (mass assignable).
     * @var array
     */
    protected $fillable = [
        'segment_id',
        'name',
        'order',
    ];

    /**
     * Hubungan BelongsTo: Fase dimiliki oleh satu Segment.
     */
    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }

    /**
     * Hubungan One-to-Many: Sebuah Fase memiliki banyak Materis.
     * Materi diurutkan berdasarkan kolom 'order'.
     */
    public function materis(): HasMany
    {
        return $this->hasMany(Materi::class)->orderBy('order');
    }
}