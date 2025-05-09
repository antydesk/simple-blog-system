<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])
    ->name('login');

Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth:api')
    ->name('logout');

Route::post('refresh-token', [AuthController::class, 'refreshToken'])
    ->name('refresh-token');

Route::post('register', [AuthController::class, 'register'])
    ->name('register');

Route::get('me', [AuthController::class, 'me'])
    ->middleware('auth:api')
    ->name('me');
