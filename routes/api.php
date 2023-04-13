<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/user_login', [AuthenticationController::class, 'user_login']);

    Route::post('/posts', [PostsController::class, 'store']);
    Route::post('/posts/{id}', [PostsController::class, 'update'])->middleware('pemilik-postingan');
    Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->middleware('pemilik-postingan');

    Route::post('/comment', [CommentController::class, 'store']);
    Route::put('/comment/{id}', [CommentController::class, 'update'])->middleware('pemilik-komentar');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->middleware('pemilik-komentar');
});

Route::get('/posts', [PostsController::class, 'index']);
Route::get('/posts/{id}', [PostsController::class, 'show']);
