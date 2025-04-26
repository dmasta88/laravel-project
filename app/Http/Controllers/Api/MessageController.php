<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StoreMessageRequest;
use App\Http\Requests\Message\UpdateMessageRequest;
use App\Http\Resources\Message\MessageResource;
use App\Services\MessageService;

class MessageController extends Controller
{
    public function index()
    {
        return MessageResource::collection(Message::all())->resolve();
    }
    public function store(StoreMessageRequest $request)
    {
        $data = $request->validated();
        $message = MessageService::store($data);
        return MessageResource::make($message)->resolve();
    }
    public function show(Message $message)
    {
        return MessageResource::make($message)->resolve();
    }
    public function update(UpdateMessageRequest $request, Message $message)
    {
        $data = $request->validated();
        $message = MessageService::update($data, $message);
        return MessageResource::make($message)->resolve();
    }
    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json(['message' => 'Message deleted']);
    }
}
