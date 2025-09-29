<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sentence extends Model
{
    protected $fillable = [
        'script_id',
        'original_sentence',
        'shotlist',
        'image_prompt',
        'video_prompt',
        'order_index',
        'status',
    ];

    public function script(): BelongsTo
    {
        return $this->belongsTo(Script::class);
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Asset::class)->where('type', 'image');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Asset::class)->where('type', 'video');
    }

    public function isProcessing(): bool
    {
        return $this->status === 'processing';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }
}
