<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use App\Models\Traits\HasLog;
use App\Models\Traits\HasLogFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    protected $guarded = [];
    use HasFactory;
    use SoftDeletes;
    use HasLog;
    use HasLogFile;
    use HasFilter;
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments(): HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, Post::class);
    }
    public function comment()
    {
        return $this->hasOneThrough(Comment::class, Post::class)->latestOfMany('published_at');
    }
}
