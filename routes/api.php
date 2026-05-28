<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('users', UserController::class);

Route::apiResource('posts', PostController::class);

Route::apiResource('categories', CategoryController::class);

Route::get('/posts/{id}/comments', [CommentController::class, 'index']);
Route::post('/posts/{id}/comments', [CommentController::class, 'store']);
Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

Route::post('/posts/{id}/likes', [LikeController::class, 'store']);
Route::delete('/posts/{id}/likes', [LikeController::class, 'destroy']);

