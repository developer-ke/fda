<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use view;

class access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        switch (Auth::user()->status) {
            case 0:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Access denied');
            case 2:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Account deleted');
            default:
                return $next($request);
        }
    }
}
