<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsSelf
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeUserId = $request->route('user_id');
        $authenticatedUserId = auth()->id();

        if ((int)$routeUserId != $authenticatedUserId) {
            return response()->json([
                'message' => 'Access denied. This is not your resource.',
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
