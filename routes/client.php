<?php

use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Client\CommentController;

Route::group(['middleware' => 'auth'], function () {
    Route::get('posts/', [PostController::class, 'index'])->name('dashboard');
    Route::get('posts/{post}/show', [PostController::class, 'show'])->name('client.posts.show');
    Route::post('posts/{post}/toggle-like/', [PostController::class, 'toggleLike'])->name('client.posts.like.toggle');
    Route::get('posts/{post}/comments', [PostController::class, 'indexComments'])->name('client.posts.comments.index');
    Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])->name('client.posts.comments.store');

    Route::get('profiles/self', [ProfileController::class, 'self'])->name('client.profiles.self');
    Route::get('profiles/{profile}', [ProfileController::class, 'show'])->name('client.profiles.show');

    Route::post('comments/{comment}/toggle-like', [CommentController::class, 'toggleLike'])->name('client.comments.like.toggle');
    Route::get('comments/{comment}/children', [CommentController::class, 'children'])->name('client.comments.children');
});
