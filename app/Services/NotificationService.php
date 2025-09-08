<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Comment;
use App\Events\Post\PostLikedEvent;
use App\Jobs\Post\PostCommentedJob;
use App\Models\ProfileNotification;
use Illuminate\Support\Facades\Auth;
use App\Jobs\Comment\CommentRepliedJob;
use App\Events\Notification\StoredNotificationEvent;
use App\Http\Resources\Notification\ProfileNotificationResource;

class NotificationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function createdComment(Post $post, Comment $comment)
    {
        $notificationText = Auth::user()->profile->login . ' has commented your post: ' . $comment->content;
        $data = ['profile_id' => $post->profile->id, 'content' => $notificationText];
        $notification = ProfileNotification::create($data);
        StoredNotificationEvent::broadcast($post->profile, $notification);
        PostCommentedJob::dispatch($post, $comment)->onQueue('emails');
    }
    public static function createdReplyComment(Comment $comment, Comment $parentComment)
    {
        $notificationText = Auth::user()->profile->login . ' has replied your comment: ' . $comment->content;
        $data = ['profile_id' => $comment->profile->id, 'content' => $notificationText];
        $notification = ProfileNotification::create($data);
        StoredNotificationEvent::broadcast($comment->profile, $notification);
        CommentRepliedJob::dispatch($comment, $parentComment, Auth::user())->onQueue('emails');
    }
    public static function likedPost($post)
    {
        $data = ['profile_id' => $post->profile->id, 'content' => 'Post id: ' . $post->id . ' has been liked by ' . Auth::user()->profile->login];
        $notification = ProfileNotification::create($data);
        PostLikedEvent::dispatch($post, Auth::user(), ProfileNotificationResource::make($notification));
    }
}
