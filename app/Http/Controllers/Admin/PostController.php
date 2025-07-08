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
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Post\PostResource;
use App\Http\Requests\Post\IndexPostRequest;
use App\Http\Requests\Admin\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

class PostController extends Controller
{
    public function index(IndexPostRequest $request)
    {
        $data = $request->validated();
        $key = 'posts.index.' . md5(json_encode($data));
        $ttl = now()->addMinutes(120);
        $posts = Cache::remember($key, $ttl, function () use ($data, $request) {
            $pagination = Post::filter($data)->latest()->paginate($data['per_page'], ['*'], 'page', $data['page'])->withQueryString();
            return PostResource::collection($pagination)->toResponse($request)->getData(true);
        });
        $categories = Category::all();
        if ($request->wantsJson()) {
            return $posts;
        }
        //$posts = PostResource::collection($posts);

        return inertia('Admin/Post/Index', compact('posts', 'categories'));
    }
    public function show(Post $post)
    {
        $cacheKey = "post:show:{$post->id}";
        $post = Cache::remember($cacheKey, now()->addMinutes(120), function () use ($post) {
            return PostResource::make($post)->resolve();
        });
        //$post = PostResource::make($post)->resolve();
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

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        PostService::update($post, $data);
        $cacheKey = "post:show:{$post->id}";
        Cache::forget($cacheKey);
        return PostResource::make($post)->resolve();
    }
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $post = PostService::store($data);
        return PostResource::make($post)->resolve();
    }
    public function destroy(Post $post)
    {
        PostService::destroy($post);
        return response()->json(['message' => 'Deleted']);
    }
    public function toggleLike(Post $post)
    {
        $post->whoLiked()->toggle(Auth::user()->profile->id);
        return PostResource::make($post->fresh())->resolve();
        //return response(['is_liked' => count($res['attached']) > 0]);
    }
    public function flushCache()
    {
        Cache::flush();
        return response(['message' => 'cache was flushed'], Response::HTTP_OK);
    }
}
