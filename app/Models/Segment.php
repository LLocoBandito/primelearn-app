<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Segment extends Model
{
    use HasFactory;

    /**
     * Tentukan kolom yang dapat diisi secara massal (mass assignable).
     * @var array
     */
    protected $fillable = [
        'name', 
        'description',
        'image_path',
    ];

    /**
     * Hubungan One-to-Many: Sebuah Segment memiliki banyak Fases.
     * Fase diurutkan berdasarkan kolom 'order'.
     */
    public function fases(): HasMany
    {
        return $this->hasMany(Fase::class)->orderBy('order');
    }
}