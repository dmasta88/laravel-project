<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('storedNotification.{profileId}', function ($user, $profileId) {
    return (int) $user->id === (int) $profileId;
});
Broadcast::channel('messagesSend.{chatId}', function ($user, $chatId) {

    $chat = Chat::where('id', $chatId)->first();
    $profiles = $chat->profiles;
    return $profiles->contains($user->profile->id);
});
