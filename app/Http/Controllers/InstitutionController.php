<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreinstitutionRequest;
use App\Http\Requests\UpdateinstitutionRequest;
use App\Models\countries;
use App\Models\institution;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Biscolab\ReCaptcha\Facades\ReCaptcha;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $institutions = institution::join("users", "institutions.user_id", "users.id")
            ->join("users AS correspondent", "institutions.correspondet_id", "correspondent.id")
            ->join("countries", "institutions.country_id", "countries.id")
            ->select(
                "users.name AS userName",
                "users.email  AS userEmail",
                "users.image AS userImage",
                "correspondent.name AS corresponderntName",
                "correspondent.email AS correspondentEmail",
                "correspondent.image AS correspondentImage",
                "countries.name AS countryName",
                "countries.city",
                "countries.code",
                "institutions.id",
                "institutions.name AS institutionName",
                "institutions.logo",
                "institutions.phoneNumber",
                "institutions.altPhoneNumber",
                "institutions.email",
                "institutions.location",
                "institutions.address",
                "institutions.latitude",
                "institutions.longitude",
                "institutions.status",
                "institutions.created_at",
            )->orderBy("institutions.id", "desc")->get();
        return view("admin.institutions.index")->with('institutions', $institutions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::leftJoin('institutions', 'users.id', 'institutions.correspondet_id')
            ->select('users.id', 'users.email')
            ->where('users.role', 2)
            ->whereNull('institutions.correspondet_id')
            ->get();
        return view('admin.institutions.create')->with([
            'countries' => countries::orderBy('name', 'ASC')->get(),
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreinstitutionRequest $request)
    {
        if ($request->validated()) {
            $recaptcha = ReCaptcha::validate($request->input('g-recaptcha-response'));

            if (!$recaptcha) {
                return back()->withErrors(['captcha' => 'Captcha verification failed. Please try again.']);
            }
            $image = $request->file('image');
            $newImageName = Str::random(20) . time() . '.' . $image->extension();
            $image->move(public_path('assets/uploads/institutions'), $newImageName);
            $institution = new institution([
                'user_id' => Auth::user()->id,
                'correspondet_id' => $request->correspondent,
                'country_id' => $request->country,
                'name' => $request->name,
                'logo' => $newImageName,
                'phoneNumber' => $request->phoneNumber,
                'altPhoneNumber' => $request->altPhoneNumber,
                'email' => $request->email,
                'location' => $request->location,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            if ($institution->save()) {
                return back()->with('success', 'new institutions added successfully');
            }
            return back()->with('error', 'an error has occured');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (institution::find($id)) {
            $institution = institution::join("users", "institutions.user_id", "users.id")
                ->join("users AS correspondent", "institutions.correspondet_id", "correspondent.id")
                ->join("countries", "institutions.country_id", "countries.id")
                ->select(
                    "users.name AS userName",
                    "users.email  AS userEmail",
                    "users.image AS userImage",
                    "correspondent.name AS corresponderntName",
                    "correspondent.email AS correspondentEmail",
                    "correspondent.image AS correspondentImage",
                    "countries.name AS countryName",
                    "countries.city",
                    "countries.code",
                    "institutions.id",
                    "institutions.name AS institutionName",
                    "institutions.logo",
                    "institutions.phoneNumber",
                    "institutions.altPhoneNumber",
                    "institutions.email",
                    "institutions.location",
                    "institutions.address",
                    "institutions.latitude",
                    "institutions.longitude",
                    "institutions.status",
                    "institutions.created_at",
                )->where('institutions.id', $id)->orderBy("institutions.id", "desc")->first();
            return view('admin.institutions.view')->with('institution', $institution);
        }
        return back()->with('error', 'error occured');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if ($institution = institution::find($id)) {
            return view('admin.institutions.edit')->with([
                'institution' => $institution,
                'users' => User::all(),
                'countries' => countries::all(),
            ]);
        }
        return back()->with('error', 'error occured');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateinstitutionRequest $request, $id)
    {
        try {
            if ($request->validated()) {
                if ($institution = institution::find($id)) {
                    if ($request->hasFile('image')) {
                        // Delete old image file if it exists
                        $path = public_path('assets/uploads/institutions/' . $institution->logo);
                        if (File::exists($path)) {
                            File::delete($path);
                        }
                        // Process new image
                        $image = $request->file('image');
                        $newfile = Str::random(20) . time() . '.' . $image->extension();
                        $image->move(public_path('assets/uploads/institutions/'), $newfile);

                        // Update image column with new file name
                        $institution->logo = $newfile;
                    }

                    $institution->user_id = Auth::user()->id;
                    $institution->correspondet_id = $request->correspondent;
                    $institution->country_id = $request->country;
                    $institution->name = $request->name;
                    $institution->phoneNumber = $request->phoneNumber;
                    $institution->altPhoneNumber = $request->altPhoneNumber;
                    $institution->email = $request->email;
                    $institution->location = $request->location;
                    $institution->address = $request->address;
                    $institution->latitude = $request->latitude;
                    $institution->longitude = $request->longitude;
                    if ($institution->save()) {
                        return redirect()->route('admin.institutions')->with('success', 'institution updated successfully');
                    }
                }
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'An error has occured');
        }
    }

    public function activate($id)
    {
        try {
            DB::beginTransaction();
            if ($institution = institution::find($id)) {
                if ($institution->update(['status' => true])) {
                    DB::commit();
                    return back()->with('success', 'institution activated successfully');
                }
            }
        } catch (Exception $e) {
            DB::rollBack();
            // Log the error for debugging
            Log::error('Error in enableAll: ' . $e->getMessage());
            return back()->with('error', 'an error has occured');
        }
    }

    public function deactivate($id)
    {
        try {
            DB::beginTransaction();
            if ($institution = institution::find($id)) {
                if ($institution->update(['status' => false])) {
                    DB::commit();
                    return back()->with('success', 'institution deactivated successfully');
                }
            }
        } catch (Exception $e) {
            DB::rollBack();
            // Log the error for debugging
            Log::error('Error in enableAll: ' . $e->getMessage());
            return back()->with('error', 'an error has occured');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            if ($institution = institution::find($id)) {
                dd($id);
                if ($institution->delete()) {
                    DB::commit();
                    return back()->with('success', 'institution activated successfully');
                }
            }
        } catch (Exception $e) {
            DB::rollBack();
            // Log the error for debugging
            Log::error('Error in enableAll: ' . $e->getMessage());
            return back()->with('error', 'an error has occured');
        }
    }
}