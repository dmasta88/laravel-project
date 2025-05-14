<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Traits\HasLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;


    protected $guarded = [];

    //belongsToMany
    public function whoLiked()
    {
        return $this->morphToMany(Profile::class, 'likeable');
    }
    //hasMany
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
