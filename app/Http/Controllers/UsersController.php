<?php

namespace App\Http\Controllers;

use App\Http\Controllers\adminController;
use App\Models\countries;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index')->with('users', User::all());
    }
    public function fetchUsers(Request $request)
    {
        $columns = ['id', 'role', 'name', 'role', 'status', 'created_at', 'actions'];

        $query = User::query();

        if ($search = $request->input('search.value')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $totalFiltered = $query->count();

        $query->skip($request->input('start'))
            ->take($request->input('length'));

        if ($order = $request->input('order.0.column')) {
            $query->orderBy($columns[$order], $request->input('order.0.dir'));
        }

        $users = $query->get();

        $data = [];
        $counter = 1;
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id,
                'counter' => $counter++,
                'role' => $user->role,
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->image,
                'status' => $user->status,
                'created_at' => $user->created_at->toDateString(),
                'actions' => '', // Placeholder for custom render actions
            ];
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => User::count(),
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:5',
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        DB::beginTransaction();
        try {
            $password = bcrypt('12345678');
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
            ]);
            if ($user->save()) {
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'New user had been addedd successfully with the default password of 12345678'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'error' => $th->getMessage(),
                'messager' => 'error occured while saving'
            ]);
        }
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
    public function updateUserProfile(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email,' . $id,
            'phoneNumber' => 'required|numeric|unique:profiles,phoneNumber,' . $id . ',user_id',
            'altPhoneNumber' => 'nullable|numeric|unique:profiles,altPhoneNumber,' . $id . ',user_id',
            'country' => 'required',
            'gender' => 'required|string|min:4',
            'dob' => 'required|date',
            'organization' => 'required|string',
            'address' => 'required|string|min:3',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::find($id);
        if ($user) {
            $profile = Profile::where('user_id', $user->id)->first();
            if ($profile) {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();
                $profile->country_id = $request->country;
                $profile->phoneNumber = $request->phoneNumber;
                $profile->altPhoneNumber = $request->altPhoneNumber;
                $profile->organization = $request->organization;
                $profile->gender = $request->gender;
                $profile->dateOfBirth = $request->dob;
                $profile->physicalAddress = $request->address;
                $profile->save();
            } else {
                Profile::create([
                    'user_id' => $user->id,
                    'country_id' => $request->country,
                    'phoneNumber' => $request->phoneNumber,
                    'altPhoneNumber' => $request->altPhoneNumber,
                    'organization' => $request->organization,
                    'gender' => $request->gender,
                    'dateOfBirth' => $request->dob,
                    'physicalAddress' => $request->address,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'User profile has been updated successfully',
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            if (Auth::user()->role !== 1 && $user->status !== 2) {
                return response()->json(['message' => 'Unauthorized action'], 403);
            }

            // Delete user's profile image if it's not the default
            if ($user->image !== 'default.webp') {
                $image = public_path('uploads/profiles/' . $user->image);
                if (File::exists($image)) {
                    File::delete($image);
                }
            }

            // Perform delete or soft delete based on role
            if (Auth::user()->role === 1) {
                $user->delete();
                DB::commit();
                return response()->json(['message' => 'User deleted successfully'], 200);
            } else {
                $user->update(['status' => 2]);
                DB::commit();
                return response()->json(['message' => 'Account deactivated successfully'], 200);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'An error occurred', 'error' => $th->getMessage()], 500);
        }
    }


    public function denyAccess(string $id)
    {
        if ($user = User::find($id)) {
            if ($user->update(['status' => 0])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Access Denied to the  user successfully'
                ]);
            }
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occured'
        ]);
    }

    public function grantAccess(string $id)
    {
        if ($user = User::find($id)) {
            if ($user->update(['status' => 1])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Access granted to the  user successfully'
                ]);
            }
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occured'
        ]);
    }

    public function profile(string $id)
    {
        if (Profile::where('user_id', $id)->count() > 0) {
            $adminController = new adminController();
            return response()->json([
                'success' => true,
                'user' => $adminController->showProfile($id),
            ]);
        };
        return response()->json([
            'incomplete_profile' => true,
            'message' => "Sorry, the user's profile is incomplete"
        ]);
    }

    public function EditUserProfile(string $id)
    {
        $adminController = new adminController();
        return response()->json([
            'success' => true,
            'data' => [
                'user' => $adminController->showProfile($id),
                'countries' => countries::orderBy('name', 'ASC')->get()
            ],
            // 'user' => $adminController->showProfile($id),
            // 'countries' => countries::orderBy('name', 'ASC')->get()
        ], 200);
    }

    public function permissionMatrix()
    {
        return view('admin.users.permission')->with('users', User::OrderBy('id', 'DESC')->get());
    }

    public function role_1(string $id)
    {
        if ($user = User::find($id)) {
            if ($user->update(['role' => 1])) {
                return response()->json([
                    'success' => true,
                    'message' => 'User been promoted to admin successfully'
                ]);
            }
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occured'
        ]);
    }
    public function role_2(string $id)
    {
        if ($user = User::find($id)) {
            if ($user->update(['role' => 2])) {
                return response()->json([
                    'success' => true,
                    'message' => 'User has been promoted or demoted to correspondent successfully.'
                ]);
            }
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occured'
        ]);
    }
    public function role_3(string $id)
    {
        if ($user = User::find($id)) {
            if ($user->update(['role' => 3])) {
                return response()->json([
                    'success' => true,
                    'message' => 'User has been demoted to subscriber successfully.'
                ]);
            }
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occured'
        ]);
    }

    public function GrantAllAccess()
    {
        //get all the users
        try {
            DB::beginTransaction();
            // bulk update
            User::query()->update(['status' => 1]);
            // commit the changes
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'All users has been granted an access'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function DenyAllAccess()
    {
        //get all the users
        try {
            DB::beginTransaction();
            // bulk update
            User::where('id', '!=', Auth::id())->update(['status' => 0]);
            // commit the changes
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'All users has been granted an access'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function DeleteAll()
    {
        try {
            // Begin a transaction
            DB::beginTransaction();
            // Get all users
            User::where('id', '!=', Auth::id())->update(['status' => 2]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'All user has been deleted',
            ]);
        } catch (\Throwable $th) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ]);
        }
    }
}