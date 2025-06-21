<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProfileRequest;
use App\Http\Resources\Profile\ProfileResource;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        $profiles = ProfileResource::collection($profiles)->resolve();
        return Inertia::render('Admin/Profile/Index', compact('profiles'));
    }
    public function show(Profile $profile)
    {
        $profile = ProfileResource::make($profile)->resolve();
        return Inertia::render('Admin/Profile/Show', compact('profile'));
    }
    public function create()
    {
        return Inertia::render('Admin/Profile/Create');
    }
    public function store(StoreProfileRequest $request)
    {
        $data = $request->validated();
        $profile = Profile::create($data);
        return ProfileResource::make($profile)->resolve();
    }
}
