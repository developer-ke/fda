<?php

namespace App\Http\Middleware;

use App\Models\CarouselOne;
use App\Models\CarouselTwo;
use App\Models\ContactUS;
use App\Models\Drawers;
use App\Models\FoundDocuments;
use App\Models\institution;
use App\Models\lostDocuments;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Notifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $usersCount = User::where('status', '!=', 1)->count();
            $drawer = Drawers::where('user_id', Auth::user()->id)->where('status', 0)->count();
            $lostDocuments = lostDocuments::where('status', 0)->count();
            $messages = ContactUS::where('status', 0)->count();
            $foundDocuments = FoundDocuments::where('status', 0)->count();
            $adverts = CarouselOne::where('status', 0)->count() + CarouselTwo::where('status', 0)->count();
            $institutions = institution::where('status', 0)->count();

            if ($drawer > 0) {
                session()->flash('drawers', $drawer);
            }
            if ($drawer > 0) {
                session()->flash('drawers', $drawer);
            }
            if ($institutions > 0) {
                session()->flash('institutions', $institutions);
            }
            if ($adverts > 0) {
                session()->flash('adverts', $adverts);
            }
            if ($foundDocuments > 0) {
                session()->flash('foundDocuments', $foundDocuments);
            }
            if ($messages > 0) {
                session()->flash('messages', $messages);
            }
            if ($lostDocuments > 0) {
                session()->flash('lostDocuments', $lostDocuments);
            }
            if ($usersCount > 0) {
                session()->flash('users', $usersCount);
            }

            // for correspondent and subscriber's notifications
            $usersLostDocs = lostDocuments::where('email', Auth::user()->email)->where('status', 0)->count();
            $usersFoundDocs = FoundDocuments::where('reprter_email', Auth::user()->email)->where('status', 0)->count();
            if ($usersLostDocs > 0) {
                session()->flash('lostdocs', $usersLostDocs);
            }
            if ($usersFoundDocs > 0) {
                session()->flash('userFoundDocs', $usersFoundDocs);
            }

        } catch (\Exception $e) {
            // Log the exception
            Log::error("Error fetching users: " . $e->getMessage());
        }
        return $next($request);

    }
}
