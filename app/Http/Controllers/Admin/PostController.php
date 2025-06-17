<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use function Termwind\render;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Http\Resources\Post\PostResource;
use App\Http\Requests\Admin\StorePostRequest;

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
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $images = $data['images'];
        unset($data['images']);
        $post = Post::create($data);
        foreach ($images as $image) {
            $path = Storage::disk('public')->put('images', $image);
            $post->images()->create(['image_path' => $path]);
        }
        return PostResource::make($post)->resolve();
    }
}
