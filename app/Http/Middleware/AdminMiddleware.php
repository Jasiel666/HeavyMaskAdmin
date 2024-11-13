<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_api_token')) {
            return redirect()->route('login')
                ->withErrors('Please login to continue.');
        }

        return $next($request);
    }
}
