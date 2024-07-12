<?php

namespace App\Http\Middleware;

use App\Models\Profile as userProfile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Profile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = userProfile::where('user_id', Auth::user()->id)->first();
        if (!$user) {
            session()->flash('complete_profile', 'Please complete your profile');
        }
        return $next($request);;
    }
}
