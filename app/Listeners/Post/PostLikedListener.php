<?php

namespace App\Listeners\Post;

use App\Jobs\Post\PostLikedJob;
use App\Events\Post\PostLikedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Notification\StoredNotificationEvent;

class PostLikedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostLikedEvent $event): void
    {
        StoredNotificationEvent::broadcast($event->post->profile, $event->notification);
        PostLikedJob::dispatch($event->post, $event->user)->onQueue('emails');
    }
}
