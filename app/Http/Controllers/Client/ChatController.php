<?php

namespace App\Http\Controllers\Client;

use App\Models\Chat;
use Inertia\Inertia;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Mappers\Chat\ChatMapper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Mappers\Profile\ProfileMapper;
use App\Http\Resources\Chat\ChatResource;
use App\Events\Message\StoredMessageEvent;
use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Http\Requests\Message\StoreMessageRequest;
use App\Http\Requests\Client\Chat\StoreChatRequest;

class ChatController extends Controller
{
    public function index()
    {

        return Inertia::render('Client/Chat/Index', ChatMapper::index());
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
        return Inertia::render('Client/Chat/Show', ChatMapper::show($chat));
    }
    public function create()
    {
        return Inertia::render('Client/Chat/Create', ChatMapper::create());
    }
    public function storeMessage(Chat $chat, StoreMessageRequest $request)
    {
        $data = $request->validated();
        $message = $chat->messages()->create($data);
        StoredMessageEvent::broadcast($message)->toOthers();
        //broadcast(new StoredMessageEvent($message))->toOthers();
        return MessageResource::make($message)->resolve();
    }
}
