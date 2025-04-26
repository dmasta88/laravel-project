<?php

namespace App\Http\Controllers\Api;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\StoreProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Requests\Store\UpdateRepostRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    public function index()
    {
        return ProfileResource::collection(Profile::all())->resolve();
    }
    public function store(StoreProfileRequest $request)
    {
        $data = $request->validated();
        $profile = ProfileService::store($data);
        return ProfileResource::make($profile)->resolve();
    }
    public function show(Profile $profile)
    {
        return ProfileResource::make($profile)->resolve();
    }
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $data = $request->validated();
        $profile = ProfileService::update($data, $profile);
        return ProfileResource::make($profile)->resolve();
    }
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response()->json(['message' => 'Profile deleted']);
    }
}
