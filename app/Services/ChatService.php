<?php

namespace App\Services;

use App\Models\Chat;

class ChatService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function store($data)
    {
        return Chat::create($data);
    }
    public static function update(Chat $chat, $data)
    {
        $chat->update($data);
        return $chat;
    }
}
