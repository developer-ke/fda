<?php

namespace App\Http\Controllers;

use App\Http\Controllers\adminController;
use App\Models\countries;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        $password = bcrypt('12345678');
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);
        if ($user->save()) {
            return back()->with('success', 'New user registered successfully with the default password of 12345678');
        }
        return back()->with('error', 'an error has occured');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($user = User::find($id)) {
            $delete = $user->update(['status' => 2]);
            if ($delete) {
                return back()->with('success', 'Account deleted successfully');
            }
        }
        return back()->with('error', 'An error occured');

    }

    public function denyAccess(string $id)
    {
        if ($user = User::find($id)) {
            if ($user->update(['status' => 0])) {
                return back()->with('success', 'user  has been denied an access successfully');
            }
        }
        return back()->with('error', 'An error occured');
    }

    public function grantAccess(string $id)
    {
        if ($user = User::find($id)) {
            if ($user->update(['status' => 1])) {
                return back()->with('success', 'user  has been granted an access successfully');
            }
        }
        return back()->with('error', 'An error occured');
    }

    public function profile(string $id)
    {
        if (Profile::where('user_id', $id)->count() > 0) {
            $adminController = new adminController();
            return view('admin.users.view')->with('user', $adminController->showProfile($id));
        };
        return back()->with('error', "users's profile is incomplete");

    }

    public function EditUserProfile(string $id)
    {
        $adminController = new adminController();
        return view('admin.users.edit')->with([
            'user' => $adminController->showProfile($id),
            'countries' => countries::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function permissionMatrix()
    {
        return view('admin.users.permission')->with('users', User::OrderBy('id', 'DESC')->get());
    }

    public function role_1(string $id)
    {
        if ($user = User::find($id)) {
            if ($user->update(['role' => 1])) {
                return back()->with('success', 'User role changed to admin successfully.');
            }
        }
        return back()->with('error', 'An error occured');
    }
    public function role_2(string $id)
    {
        if ($user = User::find($id)) {
            if ($user->update(['role' => 2])) {
                return back()->with('success', 'User role changed  to correspondent successfully.');
            }
        }
        return back()->with('error', 'An error occured');
    }
    public function role_3(string $id)
    {
        if ($user = User::find($id)) {
            if ($user->update(['role' => 3])) {
                return back()->with('success', 'User role changed to subscriber successfully.');
            }
        }
        return back()->with('error', 'An error occured');
    }

    public function GrantAllAccess()
    {
        //get all the users
        $users = User::all();
        foreach ($users as $user) {
            $user->update(['status' => 1]);
        }
        return back()->with('success', 'All users granted an access');
    }
    public function DenyAllAccess()
    {
        //get all the users
        $users = User::all();
        foreach ($users as $user) {
            if ($user->id != Auth::user()->id) {
                $user->update(['status' => 0]);
            }
        }
        return back()->with('success', 'All users have been denied an access');
    }
    public function DeleteAll()
    {
        //get all the users
        $users = User::all();
        foreach ($users as $user) {
            if ($user->id != Auth::user()->id) {
                $user->update(['status' => 2]);
            }
        }

        return back()->with('success', 'All users accounts has been deleted');
    }
}
