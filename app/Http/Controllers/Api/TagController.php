<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\Tag\TagResource;
use App\Services\TagService;

class TagController extends Controller
{
    public function index()
    {
        return TagResource::collection(Tag::all())->resolve();
    }
    public function store(StoreTagRequest $request)
    {
        $data = $request->validated();
        $tag = TagService::store($data);
        return TagResource::make($tag)->resolve();
    }
    public function show(Tag $tag)
    {
        return TagResource::make($tag)->resolve();
    }
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $tag = TagService::update($data, $tag);
        return TagResource::make($tag)->resolve();
    }
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(['message' => 'Tag deleted']);
    }
}
