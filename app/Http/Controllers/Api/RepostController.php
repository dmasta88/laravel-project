<?php

namespace App\Http\Controllers\Api;

use App\Models\Repost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreRepostRequest;
use App\Http\Requests\Store\UpdateRepostRequest;
use App\Http\Resources\Repost\RepostResource;
use App\Services\RepostService;

class RepostController extends Controller
{
    public function index()
    {
        return RepostResource::collection(Repost::all())->resolve();
    }
    public function store(StoreRepostRequest $request)
    {
        $data = $request->validated();
        $repost = RepostService::store($data);
        return RepostResource::make($repost)->resolve();
    }
    public function show(Repost $repost)
    {
        return RepostResource::make($repost)->resolve();
    }
    public function update(UpdateRepostRequest $request, Repost $repost)
    {
        $data = $request->validated();
        $repost = RepostService::update($data, $repost);
        return RepostResource::make($repost)->resolve();
    }
    public function destroy(Repost $repost)
    {
        $repost->delete();
        return response()->json(['message' => 'Repost deleted']);
    }
}
