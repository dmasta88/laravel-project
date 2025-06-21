<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Tag;
use App\Models\Post;
use Inertia\Inertia;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Services\PostService;
use function Termwind\render;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Post\PostResource;
use App\Http\Requests\Admin\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $posts = PostResource::collection($posts)->resolve();
        return inertia('Admin/Post/Index', compact('posts'));
    }
    public function show(Post $post)
    {
        $post = PostResource::make($post)->resolve();
        return inertia('Admin/Post/Show', compact('post'));
    }
    public function create()
    {
        $categories = Category::all();
        return inertia('Admin/Post/Create', compact('categories'));
    }
    public function edit(Post $post)
    {
        $categories = Category::all();
        $post = PostResource::make($post)->resolve();
        return inertia('Admin/Post/Edit', compact('post', 'categories'));
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message' => 'Deleted']);
    }
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        PostService::update($post, $data);
        return PostResource::make($post)->resolve();
    }
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $post = PostService::store($data);
        return PostResource::make($post)->resolve();
    }
}
