<?php

namespace App\Models;

use App\Models\Traits\HasLog;
use App\Observers\PostObserver;
use App\Models\Traits\HasFilter;
use App\Models\Traits\HasLogFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

//#[ObservedBy(PostObserver::class)]

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    //use HasLog;
    //use HasLogFile;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function images()
    {

        return $this->hasMany(Image::class);
        //return $this->morphOne(Image::class, 'imageable');
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
    public function getImageUrlsAttribute()
    {
        return $this->images->pluck('url')->toArray();
    }
}
