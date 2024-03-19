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
                return redirect()->route('access_denied')->with('error', 'access denied');
                break;
            case 2:
                return redirect()->route('deletedAccount')->with('error', 'Account deleted');
                break;
            default:
                return $next($request);
                break;
        }
    }
}
