<?php

namespace App\Jobs\Comment;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Mail;
use App\Mail\Comment\RepliedCommentMail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentRepliedJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Comment $parentComment, private Comment $comment, private User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->parentComment->user)->send(new RepliedCommentMail($this->comment, $this->parentComment, $this->user->profile));
    }
}
