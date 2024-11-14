<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->bearerToken()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['message' => 'Invalid or expired token'], 401);
        }
    
        return $next($request);
    }
}
