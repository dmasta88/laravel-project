<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Like\StoreLikeRequest;
use App\Http\Requests\Like\UpdateLikeRequest;
use App\Http\Resources\Like\LikeResource;
use App\Services\LikeService;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LikeResource::collection(Like::all())->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLikeRequest $request)
    {

        $data = $request->validated();
        $like = LikeService::store($data);
        return LikeResource::make($like)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        return LikeResource::make($like)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLikeRequest $request, Like $like)
    {
        $data = $request->validated();
        $like = LikeService::update($data, $like);
        return LikeResource::make($like)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        $like->delete();
        return response()->json(['message' => 'Like deleted']);
    }
}
