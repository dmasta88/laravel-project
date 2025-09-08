<?php

namespace App\Mappers\Profile;

use App\Models\Chat;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\Profile\ProfileResource;

class ProfileMapper
{
    public static function index()
    {
        return [
            'profiles' => ProfileResource::collection(Profile::where('id', '!=', Auth::user()->profile->id)->get())->resolve()
        ];
    }
    public static function self()
    {
        return [
            'profile' => Auth::user()->profile,
            'posts' => PostResource::collection(Auth::user()->profile->posts)->resolve()
        ];
    }
    public static function show(Profile $profile)
    {
        return [
            'posts' => PostResource::collection($profile->posts)->resolve(),
            'profile' => ProfileResource::make($profile)->resolve()
        ];
    }
}
