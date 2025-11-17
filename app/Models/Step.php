<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Step extends Model
{
    use HasFactory;
    
    protected $fillable = ['materi_id', 'order', 'title', 'content', 'image_path'];

    public function materi(): BelongsTo
    {
        return $this->belongsTo(Materi::class);
    }
}