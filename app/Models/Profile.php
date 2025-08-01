<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFilter;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }
    public function likedPosts()
    {
        return $this->morphedByMany(Post::class, 'likeable');
        //return $this->belongsToMany(Post::class, 'post_profile_likes');
    }
    public function likedArticles()
    {
        return $this->morphedByMany(Article::class, 'likeable');
        //return $this->belongsToMany(Post::class, 'post_profile_likes');
    }
    public function repostedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_profile_reposts');
    }
    public function viewedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_profile_views');
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function createdChats()
    {
        return $this->hasMany(Chat::class, 'creator_id');
    }
    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }
}
