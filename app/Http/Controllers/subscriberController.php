<?php

namespace App\Http\Controllers;

use App\Models\countries;
use App\Models\Drawers;
use App\Models\FoundDocuments;
use App\Models\lostDocuments;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class subscriberController extends Controller
{

    public function showProfile($user_id)
    {
        $user = User::leftjoin('profiles', 'profiles.user_id', 'users.id')
            ->leftjoin('countries', 'profiles.country_id', 'countries.id')
            ->where('users.id', $user_id)
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.provider',
                'users.image',
                'users.status',
                'users.created_at',
                'users.email_verified_at',
                'users.role',
                'profiles.phoneNumber',
                'profiles.altPhoneNumber',
                'profiles.physicalAddress',
                'profiles.organization',
                'profiles.created_at AS completed_at',
                'profiles.gender',
                'profiles.dateOfBirth',
                'countries.name AS countryName',
                'countries.nationality',
                'countries.code',
                'countries.abbreviation',
                'countries.city'
            )->first();
        return $user;
    }
    // display admin profile
    public function profile()
    {

        return view('subscriber.profile.index')->with('user', $this->showProfile(Auth::user()->id));
    }

    public function EditProfile()
    {
        return view('subscriber.profile.edit')->with([
            'user' => $this->showProfile(Auth::user()->id),
            'countries' => countries::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function UpdateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name,' . Auth::user()->id,
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'phoneNumber' => 'required|numeric|unique:profiles,user_id,' . Auth::user()->id,
            'altPhoneNumber' => 'nullable|required|numeric|unique:profiles,user_id,' . Auth::user()->id,
            'country' => 'required',
            'gender' => 'required|string|min:4',
            'dob' => 'required|date',
            'organization' => 'required|string',
            'address' => 'required|string|min:6',
        ]);

        if ($user = User::find(Auth::user()->id)) {
            if ($profile = Profile::where('user_id', $user->id)->first()) {
                $updateUser = $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
                $updateProfile = $profile->update([
                    'country_id' => $request->country,
                    'phoneNumber' => $request->phoneNumber,
                    'altPhoneNumber' => $request->altPhoneNumber,
                    'organization' => $request->organization,
                    'gender' => $request->gender,
                    'dateOfBirth' => $request->dob,
                    'physicalAddress' => $request->address,
                ]);
                if ($updateProfile && $updateUser) {
                    return back()->with('success', 'profile Updated successfully');
                }
            }
        }

        return back()->with('error', 'an error occured');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('subscriber.index')->with([
            'lostDocuments' => lostDocuments::all(),
            'drawers' => Drawers::all(),
            'foundDocuments' => FoundDocuments::all(),
        ]);
    }
}