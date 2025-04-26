<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function store(array $data)
    {
        return Message::create($data);
    }
    public static function update(array $data, Message $message)
    {
        $message->update($data);
        return $message;
    }
}
