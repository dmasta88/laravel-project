<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function store($data)
    {
        return Post::create($data);;
    }
    public static function update(Post $post, $data)
    {
        $post->update($data);
        return $post;
    }
}
