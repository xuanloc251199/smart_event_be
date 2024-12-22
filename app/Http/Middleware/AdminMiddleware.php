<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu user đã đăng nhập và có role_id = 1 (admin)
        if (Auth::check() && Auth::user()->role_id === 1) {
            return $next($request);
        }

        // Nếu không phải admin, trả về lỗi Unauthorized
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
