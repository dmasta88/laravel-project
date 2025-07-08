<?php

use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Client\CommentController;

Route::group(['middleware' => 'auth'], function () {
    Route::get('posts/', [PostController::class, 'index'])->name('dashboard');
    Route::get('posts/{post}/show', [PostController::class, 'show'])->name('client.posts.show');
    //Route::get('posts/{post}/comments', [PostController::class, 'postComments'])->name('client.posts.comments.index');
    Route::get('posts/{post}/comments', [PostController::class, 'indexComments'])->name('client.posts.comments.index');
    Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])->name('client.posts.comments.store');
    Route::post('comments/{comment}/toggle-like', [CommentController::class, 'toggleLike'])->name('client.comments.like.toggle');
    Route::post('comments/{post}/reply', [CommentController::class, 'replyComment'])->name('client.posts.comments.reply');
});
