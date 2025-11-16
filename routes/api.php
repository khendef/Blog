<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/v1'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
});

Route::get('/posts',[PostController::class,'index']);
Route::post('/posts',[PostController::class,'store']);
Route::get('/posts/{post}',[PostController::class,'show']);
Route::put('/posts/{post}',[PostController::class,'update']);
Route::delete('/posts/{post}',[PostController::class,'destroy']);

Route::get('/posts/{post}/comments',[PostController::class,'index']);
Route::post('/posts/{post}/comments',[PostController::class,'store']);
Route::get('/posts/{post}/comments/{comment}',[PostController::class,'show']);
Route::put('/posts/{post}/comments/{comment}',[PostController::class,'update']);
Route::delete('/posts/{post}/comments/{comment}',[PostController::class,'destroy']);
