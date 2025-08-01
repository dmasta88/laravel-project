<?php

namespace App\Http\Controllers\Client;

use App\Models\Chat;
use Inertia\Inertia;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Requests\Client\Chat\StoreChatRequest;
use App\Http\Resources\Message\MessageResource;
use App\Http\Requests\Message\StoreMessageRequest;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Auth::user()->profile->chats()->get();
        $myChats = Auth::user()->profile->createdChats()->get();
        return Inertia::render('Client/Chat/Index', compact('chats', 'myChats'));
        //return ChatResource::collection(Chat::all())->resolve();
    }
    public function store(StoreChatRequest $request)
    {
        $data = $request->validated();
        $existChat = Chat::where('title', $data['title'])->first();
        if ($existChat) {
            return Inertia::location(route('client.chats.show', $existChat->id));
            //return redirect()->route('client.chats.show', $existChat->id);
        }
        $profiles = $data['profile_ids'];
        unset($data['profile_ids']);
        $chat = Chat::create($data);
        $chat->profiles()->attach($profiles);
        return redirect()->route('client.chats.show', $chat->id);
    }
    public function show(Chat $chat)
    {
        $messages = MessageResource::collection($chat->messages->all())->resolve();
        return Inertia::render('Client/Chat/Show', compact('chat', 'messages'));
    }
    public function create()
    {
        $profiles = Profile::all()->except(Auth::user()->profile->id);

        return Inertia::render('Client/Chat/Create', compact('profiles'));
    }
    public function storeMessage(Chat $chat, StoreMessageRequest $request)
    {
        $data = $request->validated();
        $message = $chat->messages()->create($data);
        return MessageResource::make($message)->resolve();
    }
}
