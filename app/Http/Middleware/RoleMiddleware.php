<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user() || auth()->user()->role !== 'admin') {
            return response()->json([
                'error' => 'You are not authorized to perform this action.'
            ], 403);
        }
        return $next($request);
    }
}
