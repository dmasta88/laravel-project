<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    /**
     * Create a new class instance.
     */
    public static function store($data)
    {
        return Comment::create($data);
    }
    public static function update(Comment $comment, $data)
    {
        $comment->update($data);
        return $comment;
    }
}
