<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RepostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('post/index', [PostController::class, 'index']);
// Route::get('post/store', [PostController::class, 'store']);
// Route::get('post/{post}/show', [PostController::class, 'show']);
// Route::get('post/{post}/update', [PostController::class, 'update']);
// Route::get('post/{post}/delete', [PostController::class, 'destroy']);

// Route::get('category/index', [CategoryController::class, 'index']);
// Route::get('category/store', [CategoryController::class, 'store']);
// Route::get('category/{category}/show', [CategoryController::class, 'show']);
// Route::get('category/{category}/update', [CategoryController::class, 'update']);
// Route::get('category/{category}/destroy', [CategoryController::class, 'destroy']);

// Route::get('chat/index', [ChatController::class, 'index']);
// Route::get('chat/store', [ChatController::class, 'store']);
// Route::get('chat/{chat}/update', [ChatController::class, 'update']);
// Route::get('chat/{chat}/show', [ChatController::class, 'show']);
// Route::get('chat/{chat}/destroy', [ChatController::class, 'destroy']);

// Route::get('comment/index', [CommentController::class, 'index']);
// Route::get('comment/store', [CommentController::class, 'store']);
// Route::get('comment/{comment}/show', [CommentController::class, 'show']);
// Route::get('comment/{comment}/update', [CommentController::class, 'update']);
// Route::get('comment/{comment}/destroy', [CommentController::class, 'destroy']);

// Route::get('tag/index', [TagController::class, 'index']);
// Route::get('tag/store', [TagController::class, 'store']);
// Route::get('tag/{tag}/show', [TagController::class, 'show']);
// Route::get('tag/{tag}/update', [TagController::class, 'update']);
// Route::get('tag/{tag}/destroy', [TagController::class, 'destroy']);

// Route::get('message/index', [MessageController::class, 'index']);
// Route::get('message/store', [MessageController::class, 'store']);
// Route::get('message/{message}/show', [MessageController::class, 'show']);
// Route::get('message/{message}/update', [MessageController::class, 'update']);
// Route::get('message/{message}/destroy', [MessageController::class, 'destroy']);

// Route::get('repost/index', [RepostController::class, 'index']);
// Route::get('repost/store', [RepostController::class, 'store']);
// Route::get('repost/{repost}/show', [RepostController::class, 'show']);
// Route::get('repost/{repost}/update', [RepostController::class, 'update']);
// Route::get('repost/{repost}/destroy', [RepostController::class, 'destroy']);

// Route::get('profile/index', [ProfileController::class, 'index']);
// Route::get('profile/store', [ProfileController::class, 'store']);
// Route::get('profile/{profile}/show', [ProfileController::class, 'show']);
// Route::get('profile/{profile}/update', [ProfileController::class, 'update']);
// Route::get('profile/{profile}/destroy', [ProfileController::class, 'destroy']);

// Route::get('like/index', [LikeController::class, 'index']);
// Route::get('like/store', [LikeController::class, 'store']);
// Route::get('like/{like}/show', [LikeController::class, 'show']);
// Route::get('like/{like}/update', [LikeController::class, 'update']);
// Route::get('like/{like}/destroy', [LikeController::class, 'destroy']);

// Route::get('role/index', [RoleController::class, 'index']);
// Route::get('role/store', [RoleController::class, 'store']);
// Route::get('role/{role}/show', [RoleController::class, 'show']);
// Route::get('role/{role}/update', [RoleController::class, 'update']);
// Route::get('role/{role}/destroy', [RoleController::class, 'destroy']);
