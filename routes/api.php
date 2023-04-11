<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/posts', [PostsController::class, 'index'])->middleware(['auth:sanctum']);
Route::get('/posts/{id}', [PostsController::class, 'show'])->middleware(['auth:sanctum']);

Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);
Route::get('/user_login', [AuthenticationController::class, 'user_login'])->middleware(['auth:sanctum']);
