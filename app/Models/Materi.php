<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materi extends Model
{
    use HasFactory;

    /**
     * Tentukan kolom yang dapat diisi secara massal (mass assignable).
     * @var array
     */
    protected $fillable = [
        'fase_id',
        'title',
        'order',
    ];

    /**
     * Hubungan BelongsTo: Materi dimiliki oleh satu Fase.
     */
    public function fase(): BelongsTo
    {
        return $this->belongsTo(Fase::class);
    }

    /**
     * Hubungan HasMany: Materi memiliki banyak Steps (langkah-langkah).
     */
    public function steps(): HasMany
    {
        return $this->hasMany(Step::class)->orderBy('order');
    }

    /**
     * Hubungan HasMany: Materi memiliki banyak External Links (sumber eksternal).
     * Relasi ini akan digunakan untuk menyimpan link dokumentasi resmi yang ditambahkan 
     * oleh admin melalui Filament.
     */
}