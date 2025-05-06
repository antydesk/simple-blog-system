<?php

use App\Http\Controllers\Api\V1\Comment\CommentController;
use App\Http\Controllers\Api\V1\Login\UserLoginController;
use App\Http\Controllers\Api\V1\Post\PostController;
use App\Http\Controllers\Api\V1\Register\UserRegisterController;
use App\Http\Controllers\Api\V1\User\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::post('/register', [UserRegisterController::class, 'register']);
    Route::post('/login', [UserLoginController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/{user_id}', [UserController::class, 'show']);
            Route::put('/{user_id}', [UserController::class, 'update']);
            Route::delete('/{user_id}', [UserController::class, 'destroy']);


        Route::prefix('/{user_id}/posts')->group(function () {
            Route::post('/', [PostController::class, 'create']);
            Route::get('/{post_id}', [PostController::class, 'show']);
            Route::get('/', [PostController::class, 'index']);
            Route::put('/{post_id}', [PostController::class, 'update']);
            Route::delete('/{post_id}', [PostController::class, 'destroy']);


            Route::prefix('/{post_id}/comments')->group(function () {
                Route::post('/', [CommentController::class, 'create']);
                Route::get('/', [CommentController::class, 'index']);
                Route::get('/{comment_id}', [CommentController::class, 'show']);
                Route::put('/{comment_id}', [CommentController::class, 'update']);
                Route::delete('/{comment_id}', [CommentController::class, 'destroy']);

                Route::get('/{comment_id}/children', [CommentController::class, 'getChildren']);
            });
        });
        });
    });
});
