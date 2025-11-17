<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CommentController;
use App\Http\Controllers\Api\v1\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
});

Route::group(['prefix' => '/v1'],function(){

    Route::get('/posts',[PostController::class,'index']);
    Route::get('/posts/{post}',[PostController::class,'show']);
    Route::post('/posts',[PostController::class,'store'])->middleware('auth:api');
    Route::put('/posts/{post}',[PostController::class,'update'])->middleware('auth:api')->can('update_post','post');
    Route::delete('/posts/{post}',[PostController::class,'destroy'])->middleware('auth:api')->can('update_post','post');

    Route::get('/posts/{post}/comments',[CommentController::class,'index']);
    Route::get('/posts/{post}/comments/{comment}',[CommentController::class,'show']);
    Route::post('/posts/{post}/comments',[CommentController::class,'store'])->middleware('auth:api');
    Route::put('/posts/{post}/comments/{comment}',[CommentController::class,'update'])->middleware('auth:api')->can('update_comment','comment');
    Route::delete('/posts/{post}/comments/{comment}',[CommentController::class,'destroy'])->middleware('auth:api')->can('delete_comment','comment');


    Route::get('/categories', [CategoryController::class, 'index']);      
    Route::get('/categories/{category}', [CategoryController::class, 'show']); //lists all posts for a speicific category
    Route::group([
        'prefix' => 'admin',
        'middleware' => ['auth:api', 'can:admin_only'] 
    ], function () {

        Route::post('categories', [CategoryController::class, 'store']);
        Route::put('categories/{category}', [CategoryController::class, 'update']);
        Route::delete('categories/{category}', [CategoryController::class, 'destroy']);   

        Route::post('users', [UserController::class, 'store']);
        Route::put('users/{user}', [UserController::class, 'update']);
        Route::delete('users/{user}', [UserController::class, 'destroy']);
    });

    Route::get('/admin/users', [UserController::class, 'index']);      
    Route::get('/admin/users/{user}', [UserController::class, 'show']);

});



