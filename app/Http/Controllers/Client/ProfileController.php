<?php

namespace App\Http\Controllers\Client;

use Inertia\Inertia;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Profile\ProfileResource;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = ProfileResource::collection(Profile::where('id', '!=', Auth::user()->profile->id)->get())->resolve();
        return Inertia::render('Client/Profile/Index', compact('profiles'));
    }
    public function self()
    {
        $profile = Auth::user()->profile;
        $posts = PostResource::collection(Auth::user()->profile->posts)->resolve();
        return Inertia::render('Client/Profile/Self', compact('posts', 'profile'));
    }
    public function show(Profile $profile)
    {
        if ($profile->id === Auth::user()->profile->id) {
            return Inertia::location(route('client.profiles.self'));
        }
        $posts = PostResource::collection($profile->posts)->resolve();
        $profile = ProfileResource::make($profile)->resolve();
        return Inertia::render('Client/Profile/Show', compact('posts', 'profile'));
    }
    public function toggleFollow(Profile $profile)
    {
        //для себя (тот кто вызывает following) смотрим всех на кого мы подписаны (всех фоловингов) 
        //и добавляем туда profile id того на кого хотим подписаться
        $res = Auth::user()->profile->following()->toggle($profile->id);
        //$res = Auth::user()->profile->is_following;
        // dump($res);
        return response()->json([
            'is_followed' => count($res['attached']) > 0
        ]);
    }
}
