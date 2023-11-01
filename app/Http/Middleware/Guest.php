<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($user = Auth::user()) {
            switch ($user->group_id) {
                case 1:
                case 2:
                case 3:
                    route('admin.dashboard');
                    break;
                case 4:
                    route('home');
                    break;
            }
        }
        return $next($request);
    }
}
