<?php

namespace App\Http\Controllers\Client;

use Inertia\Inertia;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function self()
    {
        $profile = Auth::user()->profile;
        $posts = PostResource::collection(Auth::user()->profile->posts)->resolve();
        return Inertia::render('Client/Profile/Self', compact('posts', 'profile'));
    }
    public function show(Profile $profile)
    {
        $posts = PostResource::collection($profile->posts)->resolve();
        return Inertia::render('Client/Profile/Show', compact('posts', 'profile'));
    }
}
