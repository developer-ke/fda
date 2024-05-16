<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        switch (Auth::user()->role) {
            case 1:
                return redirect()->route('admin');
            case 2:
                return redirect()->route('correspondent');
            case 3:
                return redirect()->route('subscriber');
            default:
                return $next($request);
        }
    }
}
