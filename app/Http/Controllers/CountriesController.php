<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecountriesRequest;
use App\Http\Requests\UpdatecountriesRequest;
use App\Models\countries;
use Illuminate\Support\Facades\Auth;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $countries = countries::join('users', 'countries.user_id', 'users.id')
            ->select(
                'countries.id',
                'countries.abbreviation',
                'countries.code',
                'countries.name AS countryName',
                'countries.city',
                'countries.nationality',
                'countries.created_at',
                'users.name',
                'users.email',
                'users.image'
            )->orderBy('countries.id', 'DESC')->get();
        return view('admin.countries.index')->with('countries', $countries);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecountriesRequest $request)
    {
        if ($request->validated()) {
            $countries = new countries([
                'code' => $request->code,
                'abbreviation' => strtolower($request->abbreviation),
                'name' => strtolower($request->countryName),
                'city' => strtolower($request->city),
                'user_id' => Auth::user()->id,
                'nationality' => strtolower($request->nationality),
            ]);
            if ($countries->save()) {
                return back()->with('success', 'country added successfully');
            }
            return back()->with('error', 'error occured');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(countries $countries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($countryId)
    {
        if ($country = countries::find($countryId)) {
            return view('admin.countries.edit')->with('country', $country);
        }
        return back()->with('error', 'error occured');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecountriesRequest $request, $countryId)
    {
        if ($request->validated()) {
            if ($country = countries::find($countryId)) {
                if ($country->update([
                    'code' => $request->code,
                    'abbreviation' => strtolower($request->abbreviation),
                    'name' => strtolower($request->countryName),
                    'city' => strtolower($request->city),
                    'user_id' => Auth::user()->id,
                    'nationality' => strtolower($request->nationality),
                ])) {
                    return redirect()->route('admin.countries')->with('success', 'country updated successfully');
                }
            }
        }
        return back()->with('error', 'error occured');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($countryId)
    {
        if ($country = countries::find($countryId)) {
            if ($country->delete()) {
                return back()->with('success', 'country deleted successfully');
            }
        }
        return back()->with('error', 'error occured');
    }
}
