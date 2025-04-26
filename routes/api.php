<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RepostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::apiResource('posts', PostController::class);
Route::apiResources([
    'posts' => PostController::class,
    'categories' => CategoryController::class,
    'chats' => ChatController::class,
    'comments' => CommentController::class,
    'tags' => TagController::class,
    'messages' => MessageController::class,
    'reposts' => RepostController::class,
    'profiles' => ProfileController::class,
    'likes' => LikeController::class,
    'users' => UserController::class,
    'roles' => RoleController::class,
]);
