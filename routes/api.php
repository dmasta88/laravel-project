<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdminMiddleware;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\RepostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Middleware\isPermissionMiddleware;
use App\Http\Middleware\isVideoModeratorMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['api'], 'prefix' => 'auth'], function () {
    Route::post('logout',  [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
Route::group(['middleware' => ['api', isPermissionMiddleware::class]], function () {
    Route::apiResource('videos', VideoController::class);
    Route::apiResource('posts', PostController::class);
});


//Route::apiResource('posts', PostController::class);
Route::apiResources([
    'categories' => CategoryController::class,
    'chats' => ChatController::class,
    'comments' => CommentController::class,
    'tags' => TagController::class,
    'messages' => MessageController::class,
    'reposts' => RepostController::class,
    'profiles' => ProfileController::class,
    'users' => UserController::class,
    'roles' => RoleController::class,
]);
