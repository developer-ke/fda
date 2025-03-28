<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\countries;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.completeProfile')->with('countries', countries::orderBy('name', 'ASC')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        if ($request->validated()) {
            $profile = new Profile([
                'user_id' => Auth::user()->id,
                'country_id' => $request->country,
                'phoneNumber' => $request->phoneNumber,
                'altPhoneNumber' => $request->altPhoneNumber,
                'organization' => $request->organization,
                'gender' => $request->gender,
                'dateOfBirth' => $request->dob,
                'physicalAddress' => $request->address,
            ]);
            if ($profile->save()) {
                return redirect()->route('home')->with('success', 'profile upadted succesfully');
            }
            return back()->with('error', 'an error occured');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }
    public function picture()
    {
        return view('auth.changeImage');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,webp,jpeg',

        ]);
        // return response()->json([
        //     'success' => true,
        //     'message' => $request->all()
        // ]);
        $user = User::where('id', Auth::user()->id)->firstOrFail();

        $image = $request->file('image');
        $newFileName = Str::random(20) . '.' . $image->getClientOriginalExtension();

        DB::beginTransaction();
        try {
            // Store the new image
            $image->move(public_path('uploads/profiles'), $newFileName);

            // Delete the old image if it's not the default one
            if ($user->image != 'default.webp') {
                $prevImage = public_path('uploads/profiles/' . $user->image);
                if (File::exists($prevImage)) {
                    File::delete($prevImage);
                }
            }

            // Update the user's image path in the database
            if ($user->update(['image' => $newFileName])) {
                DB::commit();
                return redirect()->route('home')->with('success', 'Profile picture updated successfully');
            };
        } catch (\Exception $e) {
            Log::error('error occured due to' . $e->getMessage());
            DB::rollBack();
            // Optionally, log the error or handle it as needed
            return back()->with('errors', 'Error occured, please try again');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (Hash::check($request->password, Auth::user()->password)) {
            // get the user
            if ($user = User::find(Auth::user()->id)) {
                if ($user->update(['status' => 2])) {
                    return back();
                }
            }
        } else {
            return back()->with('error', 'Incorrect password');
        }
    }
}