<?php

namespace App\Listeners\Post;

use App\Jobs\Post\PostLikedJob;
use App\Events\Post\PostLikedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        PostLikedJob::dispatch($event->post, $event->user)->onQueue('emails');
    }
}
