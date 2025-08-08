<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\ProfileNotification;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function create(Comment $comment)
    {
        $notification = Auth::user()->profile->login . ' has replied your comment';
        $data = ['profile_id' => $comment->profile->id, 'content' => $notification];
        ProfileNotification::create($data);
    }
}
