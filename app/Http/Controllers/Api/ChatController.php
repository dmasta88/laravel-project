<?php

namespace App\Http\Controllers\Api;

use App\Models\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\IndexChatRequest;
use App\Http\Requests\Chat\StoreChatRequest;
use App\Http\Requests\Chat\UpdateChatRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Services\ChatService;

class ChatController extends Controller
{
    public function index(IndexChatRequest $request)

    {
        $data = $request->validated();
        $chats = Chat::filter($data)->get();
        return ChatResource::collection($chats)->resolve();
    }
    public function store(StoreChatRequest $request)
    {
        $data = $request->validated();
        return ChatResource::make(ChatService::store($data))->resolve();
    }
    public function show(Chat $chat)
    {
        return ChatResource::make($chat);
    }
    public function update(UpdateChatRequest $request, Chat $chat)
    {
        $data = $request->validated();
        $chat = ChatService::update($chat, $data);
        return ChatResource::make($chat)->resolve();
    }
    public function destroy(Chat $chat)
    {
        $chat->delete($chat);
        return response()->json(['message' => 'Chat deleted']);
    }
}
