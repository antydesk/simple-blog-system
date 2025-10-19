<?php

use App\Http\Middleware\EnsureUserIsSelf;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
        then: function () {
            Route::prefix('auth')
                ->name('auth.')
                ->group(base_path('routes/auth.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['ensure.user.self' => EnsureUserIsSelf::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //        $exceptions->renderable(function (Throwable $e, $request) {
        //            if ($e instanceof AuthenticationException) {
        //                return response()->json([
        //                    'message' => 'Unauthenticated.',
        //                ], 401);
        //            }
        //
        //            if ($e instanceof ValidationException) {
        //                return response()->json([
        //                    'message' => 'Validation failed.',
        //                    'errors' => $e->errors(),
        //                ], 422);
        //            }
        //
        //            return response()->json([
        //                'message' => $e->getMessage(),
        //            ], 500);
        //        });
    })
    ->create();
