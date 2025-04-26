<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    // public function whoLiked()
    // {
    //     return $this->belongsToMany(Profile::class, 'post_profile_likes');
    // }   
    public function whoLiked()
    {
        return $this->morphToMany(Profile::class, 'likeable');
    }
    public function whoViews()
    {
        return $this->belongsToMany(Profile::class, 'post_profile_views');
    }
    public function whoReposted()
    {
        return $this->belongsToMany(Profile::class, 'post_profile_reposts');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }    
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
