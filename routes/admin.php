<?php

use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('posts/', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('posts/store', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('admin.posts.show');
});


Route::get('admin/categories/', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('admin/categories/', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('admin/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');

Route::get('admin/tags/', [TagController::class, 'index'])->name('admin.tags.index');
Route::get('admin/tags/create', [TagController::class, 'create'])->name('admin.tags.create');
Route::post('admin/tags/', [TagController::class, 'store'])->name('admin.tags.store');
Route::get('admin/tags/{tag}', [TagController::class, 'show'])->name('admin.tags.show');

Route::get('admin/profiles', [ProfileController::class, 'index'])->name('admin.profiles.index');
Route::get('admin/profiles/create', [ProfileController::class, 'create'])->name('admin.profiles.create');
Route::post('admin/profiles/store', [ProfileController::class, 'store'])->name('admin.profiles.store');
Route::get('admin/profiles/{profile}', [ProfileController::class, 'show'])->name('admin.profiles.show');

Route::get('admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');
Route::get('admin/roles/{role}', [RoleController::class, 'show'])->name('admin.roles.show');
