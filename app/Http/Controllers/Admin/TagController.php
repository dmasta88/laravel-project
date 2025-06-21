<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTagRequest;
use App\Http\Resources\Tag\TagResource;
use Inertia\Inertia;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $tags = TagResource::collection($tags)->resolve();
        return Inertia::render('Admin/Tag/Index', compact('tags'));
    }
    public function show(Tag $tag)
    {
        $tag = TagResource::make($tag)->resolve();
        return Inertia::render('Admin/Tag/Show', compact('tag'));
    }
    public function create()
    {
        return Inertia::render('Admin/Tag/Create');
    }
    public function store(StoreTagRequest $request)
    {
        $tag = $request->validated();
        return TagResource::make(Tag::create($tag))->resolve();
    }
}
