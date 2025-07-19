<?php

namespace App\Jobs\Post;

use App\Models\Post;
use App\Models\User;
use App\Mail\Post\LikedPostMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostLikedJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Post $post, private User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->post->user)->send(new LikedPostMail($this->post, $this->user));
    }
}
