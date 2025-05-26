<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\IndexCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Requests\Comment\StoreCommentRequest;

class CommentController extends Controller
{
    public function index(IndexCommentRequest $request)
    {
        $data = $request->validated();
        //$comment = Comment::query();
        // $comments = $comment->whereHasMorph('commentable', [\App\Models\Post::class], function ($query) use ($data) {
        //     //$query->where('title', 'ilike', '%Fish%');
        //     //$query->where('title', '123');
        //     $query->whereRelation('category', 'title', 'veritatis');
        // })->get();

        $comments = Comment::filter($data)->get();
        return CommentResource::collection($comments)->resolve();
    }
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        $comment = CommentService::store($data);
        return CommentResource::make($comment)->resolve();
    }
    public function show(Comment $comment)
    {
        return CommentResource::make($comment)->resolve();
    }
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $data = $request->validated();
        $comment = CommentService::update($comment, $data);
        return CommentResource::make($comment)->resolve();
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['message' => 'deleted']);
    }
}
