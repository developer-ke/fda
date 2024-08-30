<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartnersRequest;
use App\Http\Requests\UpdatePartnersRequest;
use App\Models\Partners;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partners::join('users', 'partners.user_id', 'users.id')
            ->select([
                'users.image',
                'users.name',
                'users.email',
                'partners.id',
                'partners.logo',
                'partners.status',
                'partners.created_at'
            ])->orderBy('partners.id', 'DESC')->get();
        return view('admin.partners.index')->with('partners', $partners);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnersRequest $request)
    {
        if ($request->validated()) {
            $logo = $request->file('logo');
            $newLogo = Str::random(20) . '.' . $logo->getClientOriginalExtension();
            DB::beginTransaction();
            try {
                // Store the new image
                $logo->move(public_path('assets/cms/'), $newLogo);
                $partner = new Partners([
                    'user_id' => Auth::user()->id,
                    'logo' => $newLogo,
                ]);
                if ($partner->save()) {
                    DB::commit();
                    return  back()->with('success', 'New partner added successfully');
                }
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('error' . $e->getMessage());
                return back()->with('error', 'An error occured');
            }
        }
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get the partner
        return view('admin.partners.edit')->with('partner', Partners::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnersRequest $request, string $id)
    {
        if ($request->validated()) {
            $partner = Partners::find($id);
            $existingLogo = public_path("assets/cms/" . $partner->logo);
            $logo = $request->file('logo');
            $newLogo = Str::random(20) . '.' . $logo->getClientOriginalExtension();
            DB::beginTransaction();
            try {
                // Store the new image
                $logo->move(public_path('assets/cms/'), $newLogo);
                $partner = new Partners([
                    'user_id' => Auth::user()->id,
                    'logo' => $newLogo,
                ]);
                if ($partner->save()) {
                    if (File::exists($existingLogo)) {
                        File::delete($existingLogo);
                    }
                    DB::commit();
                    return  redirect()->route('admin.partner')->with('success', 'Partnership updated  successfully');
                }
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('error' . $e->getMessage());
                return back()->with('error', 'An error occured');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $partner = Partners::find($id);
            if ($partner->delete()) {
                // remove it's logo
                $existingLogo = public_path("assets/cms/" . $partner->logo);
                if (File::exists($existingLogo)) {
                    File::delete($existingLogo);
                }
                DB::commit();
                return  back()->with('success', 'Partnership deleted  successfully');
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('error' . $e->getMessage());
            return back()->with('error', 'An error occured');
        }
    }
    public function enable(string $id)
    {
        DB::beginTransaction();
        try {
            $partner = Partners::find($id);
            if ($partner->update(['status' => true])) {
                DB::commit();
                return  back()->with('success', 'Partnership enabled successfully');
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('error' . $e->getMessage());
            return back()->with('error', 'An error occured');
        }
    }
    public function disable(string $id)
    {
        DB::beginTransaction();
        try {
            $partner = Partners::find($id);
            if ($partner->update(['status' => false])) {
                DB::commit();
                return  back()->with('success', 'Partnership disabled  successfully');
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('error' . $e->getMessage());
            return back()->with('error', 'An error occured');
        }
    }
}
