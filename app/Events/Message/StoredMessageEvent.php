<?php

namespace App\Events\Message;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use App\Http\Resources\Message\MessageResource;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Http\Resources\Message\BroadcastMessageResource;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class StoredMessageEvent implements ShouldBroadcastNow //ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(private Message $message)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel('messagesSend.' . $this->message->chat_id);
    }
    public function broadcastAs()
    {
        return 'my-event';
    }
    public function broadcastWith(): array
    {
        return [
            'message' => BroadcastMessageResource::make($this->message),
        ];
    }
}
