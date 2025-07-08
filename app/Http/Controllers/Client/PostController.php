<?php

namespace App\Http\Controllers\Client;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Post\PostResource;
use App\Http\Requests\Post\IndexPostRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Requests\Client\Post\StoreCommentRequest;
use App\Http\Requests\Client\Comment\IndexCommentRequest;

class PostController extends Controller
{
    public function index(IndexPostRequest $request)
    {
        $posts = PostResource::collection(Auth::user()->profile->posts)->resolve();
        return inertia('Client/Dashboard/Index', compact('posts'));
    }
    public function show(Post $post)
    {
        //$comments = CommentResource::collection($post->comments()->paginate(5));
        $post = PostResource::make($post)->resolve();
        return inertia('Client/Post/Show', compact('post'));
    }
    public function storeComment(Post $post, StoreCommentRequest $request)
    {
        $data = $request->validated();
        return CommentResource::make($post->comments()->create($data)->fresh());
    }
    public function indexComments(Post $post, IndexCommentRequest $request)
    {
        $data = $request->validated();
        $comments = $post->comments()->whereNull('parent_id')->paginate($data['per_page'], '*', 'page', $data['page']);
        return CommentResource::collection($comments);
    }
}
