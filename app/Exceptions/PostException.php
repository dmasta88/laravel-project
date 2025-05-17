<?php

namespace App\Exceptions;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PostException extends Exception
{
    public function __construct(private Post $post, $message = null, $code = null)
    {
        parent::__construct($message, $code);
    }
    /**
     * Report the exception.
     */
    public function report(): void
    {
        Log::channel('post')->info('Post exception: {message}', ['id' => $this->post->id, 'message' => $this->message]);
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): Response
    {
        return response([
            'message' => $this->message,
            'post_id' => $this->post->id
        ], $this->code);
    }
    public static function ifPostNotExist($post)
    {
        if (!$post) {
            throw new \App\Exceptions\PostException($post, 'post not found', 404);
        }
    }
    public static function ifPostExist($post)
    {
        if ($post) {
            throw new \App\Exceptions\PostException($post, 'post exist', 422);
        }
    }
}
