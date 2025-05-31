<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    protected $guarded = [];
    use HasFactory;
    use HasFilter;
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function category()
    {
        return $this->commentable->category();
    }
    public function tags()
    {
        return $this->post->tags();
    }
}
