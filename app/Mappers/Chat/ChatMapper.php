<?php

namespace App\Mappers\Chat;

use App\Models\Chat;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\Profile\ProfileResource;

class ChatMapper
{
    public static function index()
    {
        return [
            'chats' => ChatResource::collection(Auth::user()->profile->chats()->get())->resolve(),
            'myChats' => ChatResource::collection(Auth::user()->profile->createdChats()->get())->resolve(),
        ];
    }
    public static function show(Chat $chat)
    {
        return [
            'chat' => ChatResource::make($chat)->resolve(),
            'messages' => MessageResource::collection($chat->messages)->resolve(),
            'profiles' => ProfileResource::collection($chat->profiles)->resolve()
        ];
    }
    public static function create()
    {
        return [
            'profiles' =>  ProfileResource::collection(Profile::where('id', '!=', Auth::user()->profile->id)->get())->resolve()
        ];
    }
}
