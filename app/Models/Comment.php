<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Comment extends Model
{
    protected $guarded = [];
    protected $withCount = ['whoLiked'];
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
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }
    public function whoLiked(): MorphToMany
    {
        return $this->morphToMany(Profile::class, 'likeable');
    }
    public function getIsLikedAttribute(): bool
    {
        return $this->whoLiked->contains(Auth::user()->profile->id);
    }
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id')->latest();
    }
}
