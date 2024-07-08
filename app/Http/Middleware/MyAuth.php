<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role = 'guest'): Response
    {
        if (session('user') === null) {
            return to_route('showlogin');
        }

        if ($role == 'admin') {
            if (session('user_type') != 'Owner') {
                return to_route('home')->with('accessError', 'You are not authorized');
            }
        }
        return $next($request);
    }
}
