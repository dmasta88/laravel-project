<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Requests\Comment\StoreCommentRequest;

class CommentController extends Controller
{
    public function index()
    {
        return CommentResource::collection(Comment::all())->resolve();
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
