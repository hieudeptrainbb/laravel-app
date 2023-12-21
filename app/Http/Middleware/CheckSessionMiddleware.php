<?php

namespace App\Http\Middleware;

use Closure;

class CheckSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        if (session()->has('user_id')) {
            // Session đã được sử dụng
            // Thực hiện các hành động phù hợp
        } else {
            // Session chưa được sử dụng
            // Thực hiện các hành động phù hợp
        }

        return $next($request);
    }
}