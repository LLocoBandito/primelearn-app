<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_id',
        'path',     // ✅ tetap path
        'order',
        'caption',
    ];

    public function step()
    {
        return $this->belongsTo(Step::class);
    }

    /**
     * ✅ Accessor agar $image->image_path mengambil nilai dari 'path'
     */
    public function getImagePathAttribute()
    {
        return $this->path;
    }
}
