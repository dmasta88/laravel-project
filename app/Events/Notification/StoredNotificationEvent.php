<?php

namespace App\Events\Notification;

use App\Http\Resources\Profile\ProfileResource;
use App\Models\Profile;
use App\Models\ProfileNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class StoredNotificationEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(private Profile $profile, private ProfileNotification $notification)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('storedNotification.' . $this->profile->id),
        ];
    }
    public function broadcastAs()
    {
        return 'stored';
    }
    public function broadcastWith()
    {
        return [
            'notification' => $this->notification,
        ];
    }
}
