<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $guarded = false;
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function getUrlAttribute()
    {
        return Storage::disk('public')->url($this->image_path);
    }
}
