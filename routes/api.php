<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ThumbnailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/users/{user}/bookmarks', [UserController::class, 'bookmarks'])->middleware('auth:sanctum');
Route::post('/videos/{video}/toggle-bookmarks', [BookmarkController::class, 'toggle'])->middleware('auth:sanctum');
Route::get('/auth/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/auth/register', [AuthController::class, 'register']);
Route::get('/videos', [VideoController::class, 'index'])->middleware('auth:sanctum');
Route::post('/videos', [VideoController::class, 'store'])->middleware('auth:sanctum');
Route::get('/videos/trending', [VideoController::class, 'trending']);
Route::get('/users/{user}/videos', [VideoController::class, 'videos']);
Route::get('/videos/{video}/check-bookmark', [VideoController::class, 'checkBookmark'])->middleware('auth:sanctum');
Route::post('/images', [ThumbnailController::class, 'store']);
