<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return response()->json([
            'message' => 'Welcome to the admin dashboard!'
        ]);
    });
});

Route::middleware('auth:sanctum')->group(function () {
Route::post('/users/{user}/follow', [FollowController::class, 'follow']);
Route::delete('/users/{user}/unfollow', [FollowController::class, 'unfollow']);
Route::get('/users/{user}/followers', [FollowController::class, 'followers']);
Route::get('/users/{user}/following', [FollowController::class, 'following']);

Route::apiResource('users', UserController::class);

Route::apiResource('posts', PostController::class);});

Route::apiResource('categories', CategoryController::class);

Route::get('/posts/{id}/comments', [CommentController::class, 'index']);
Route::post('/posts/{id}/comments', [CommentController::class, 'store']);
Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

Route::post('/posts/{id}/likes', [LikeController::class, 'store']);
Route::delete('/posts/{id}/likes', [LikeController::class, 'destroy']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

