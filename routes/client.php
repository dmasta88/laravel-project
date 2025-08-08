<?php

use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Client\ChatController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\NotificationController;

Route::group(['middleware' => 'auth'], function () {
    Route::get('posts/', [PostController::class, 'index'])->name('dashboard');
    Route::get('posts/{post}/show', [PostController::class, 'show'])->name('client.posts.show');
    Route::post('posts/repost', [PostController::class, 'repost'])->name('client.posts.repost');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('client.posts.destroy');
    Route::post('posts/{post}/toggle-like/', [PostController::class, 'toggleLike'])->name('client.posts.like.toggle');
    Route::get('posts/{post}/comments', [PostController::class, 'indexComments'])->name('client.posts.comments.index');
    Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])->name('client.posts.comments.store');

    Route::get('chats/', [ChatController::class, 'index'])->name('client.chats.index');
    Route::post('chats/', [ChatController::class, 'store'])->name('client.chats.store');
    Route::get('chats/create', [ChatController::class, 'create'])->name('client.chats.create');

    Route::get('chats/{chat}/show', [ChatController::class, 'show'])->name('client.chats.show');
    Route::post('chats/{chat}/messages', [ChatController::class, 'storeMessage'])->name('client.chats.messages.store');

    Route::get('profiles/', [ProfileController::class, 'index'])->name('client.profiles.index');
    Route::get('profiles/self', [ProfileController::class, 'self'])->name('client.profiles.self');
    Route::get('profiles/{profile}', [ProfileController::class, 'show'])->name('client.profiles.show');
    Route::post('profiles/{profile}/follow/toogle', [ProfileController::class, 'toggleFollow'])->name('client.profiles.follow.toggle');

    Route::post('comments/{comment}/toggle-like', [CommentController::class, 'toggleLike'])->name('client.comments.like.toggle');
    Route::get('comments/{comment}/children', [CommentController::class, 'children'])->name('client.comments.children');

    Route::get('notifications/', [NotificationController::class, 'index'])->name('client.notifications.index');
    Route::post('notifications/markAllAsRead', [NotificationController::class, 'markAllAsRead'])->name('client.notifications.markallasread');
    Route::get('notifications/{notification}', [NotificationController::class, 'show'])->name('client.notifications.show');
    Route::post('notifications/{notification}', [NotificationController::class, 'markAsRead'])->name('client.notifications.markasread');
});
