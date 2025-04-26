<?php

namespace App\Services;

use App\Models\Like;

class LikeService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function store(array $data)
    {
        return Like::create($data);
    }
    public static function update(array $data, Like $like)
    {
        $like->update($data);
        return $like;
    }
}
