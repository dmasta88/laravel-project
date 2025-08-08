<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\ProfileNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Client\Notification\IndexNotificationRequest;
use App\Http\Resources\Notification\ProfileNotificationResource;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index(IndexNotificationRequest $request)
    {
        //$comments = $post->comments()->whereNull('parent_id')->withCount('children')->paginate($data['per_page'], '*', 'page', $data['page']);
        $data = $request->validated();
        $notifications = Auth::user()->profile->notifications()->whereNull('read_at')->latest()->paginate($data['per_page'], '*', 'page', $data['page']);
        $notifications = ProfileNotificationResource::collection($notifications);
        if ($request->wantsJson()) {
            return $notifications;
        }

        return Inertia::render('Client/Notification/Index', compact('notifications'));
    }
    public function show(ProfileNotification $notification)
    {
        $notification = ProfileNotificationResource::make($notification)->resolve();
        return Inertia::render('Client/Notification/Show', compact('notification'));
    }
    public function markAsRead(ProfileNotification $notification)
    {
        $notification->update(['read_at' => now()]);
        return response()->json(['message' => $notification]);
    }
    public function markAllAsRead()
    {
        Auth::user()->profile->notifications()->whereNull('read_at')->update(['read_at' => now()]);
        return response()->json(['message' => 'All message marked as read']);
    }
}
