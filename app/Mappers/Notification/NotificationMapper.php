<?php

namespace App\Mappers\Notification;

use App\Http\Resources\Notification\ProfileNotificationResource;
use App\Models\ProfileNotification;
use PhpParser\Node\Expr\Cast\Array_;

class NotificationMapper
{

    public static function index($notifications)
    {
        return ['notifications' => ProfileNotificationResource::collection($notifications)];
    }
    public static function show(ProfileNotification $notification)
    {
        return ['notification' => ProfileNotificationResource::make($notification)->resolve()];
    }
}
