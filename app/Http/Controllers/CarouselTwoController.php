<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarouselTwoRequest;
use App\Http\Requests\UpdateCarouselTwoRequest;
use App\Models\CarouselTwo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CarouselTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adverts = CarouselTwo::join('users', 'carousel_twos.user_id', 'users.id')
            ->select(
                'users.name',
                'users.email',
                'users.image AS userImage',
                'carousel_twos.id',
                'carousel_twos.image',
                'carousel_twos.status',
                'carousel_twos.created_at',
            )
            ->OrderBy('carousel_twos.id', 'desc')->get();
        return view('admin.carouselTwo.index')->with('adverts', $adverts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.carouselTwo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarouselTwoRequest $request)
    {
        if ($request->validated()) {
            $image = $request->file('image');
            $newfile = Str::random(20) . time() . '.' . $image->extension();
            $image->move(public_path('assets/cms/'), $newfile);
            $advert = new CarouselTwo([
                'user_id' => Auth::user()->id,
                'image' => $newfile,
            ]);
            if ($advert->save()) {
                return back()->with('success', 'Advert added successfully');
            }
            return back()->with('error', 'An error has occured');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (CarouselTwo::find($id)) {
            $advert = CarouselTwo::join('users', 'carousel_twos.user_id', 'users.id')
                ->select(
                    'users.name',
                    'users.image AS userImage',
                    'users.email',
                    'carousel_twos.image',
                    'carousel_twos.status',
                    'carousel_twos.created_at',
                )->where('carousel_twos.id', $id)->get();
            return view('admin.carouselTwo.view')->with('advert', $advert);
        }
    }

    public function enableAll()
    {
        try {
            // Start transaction
            DB::beginTransaction();
            // Update in chunks to avoid memory issues
            $chunkSize = 100; // Adjust this number based on your needs
            CarouselTwo::chunk($chunkSize, function ($adverts) {
                foreach ($adverts as $advert) {
                    $advert->update(['status' => 1]);
                }
            });

            // Commit the transaction
            DB::commit();

            return back()->with('success', 'All adverts enabled successfully');
        } catch (\Exception $e) {
            // Rollback transaction if something goes wrong
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error in enableAll: ' . $e->getMessage());

            // Return with error message
            return back()->with('error', 'An error occurred while enabling adverts');
        }
    }

    public function disableAll()
    {
        try {
            // Start transaction
            DB::beginTransaction();
            // Update in chunks to avoid memory issues
            $chunkSize = 100; // Adjust this number based on your needs
            CarouselTwo::chunk($chunkSize, function ($adverts) {
                foreach ($adverts as $advert) {
                    $advert->update(['status' => 0]);
                }
            });

            // Commit the transaction
            DB::commit();

            return back()->with('success', 'All adverts disabled successfully');
        } catch (\Exception $e) {
            // Rollback transaction if something goes wrong
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error in enableAll: ' . $e->getMessage());

            // Return with error message
            return back()->with('error', 'An error occurred while disabling adverts');
        }
    }
    public function deleteAll()
    {
        try {
            // Start transaction
            DB::beginTransaction();
            // Update in chunks to avoid memory issues
            $chunkSize = 100; // Adjust this number based on your needs
            CarouselTwo::chunk($chunkSize, function ($adverts) {
                foreach ($adverts as $advert) {
                    $image = public_path('assets/cms/' . $advert->image);
                    dd($image);
                    if (File::exists($image)) {
                        // Optionally delete the image file from the server
                        File::delete($image);
                    }
                    $advert->delete();
                }
            });

            // Commit the transaction
            DB::commit();

            return back()->with('success', 'All adverts deleted successfully');
        } catch (\Exception $e) {
            // Rollback transaction if something goes wrong
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error in enableAll: ' . $e->getMessage());

            // Return with error message
            return back()->with('error', 'An error occurred while enabling adverts');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if ($advert = CarouselTwo::find($id)) {
            return view('admin.carouselTwo.edit')->with('advert', $advert);
        }
        return back()->with('error', 'An error has occured');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarouselTwoRequest $request, string $id)
    {
        if ($request->validated()) {
            if ($advert = CarouselTwo::find($id)) {
                // Handle image upload if a new image is provided
                if ($request->hasFile('image')) {
                    // Delete old image file if it exists
                    $oldImage = $advert->image;
                    if ($oldImage && file_exists(public_path('assets/cms/' . $oldImage))) {
                        unlink(public_path('assets/cms/' . $oldImage));
                    }
                    // Process new image
                    $image = $request->file('image');
                    $newfile = Str::random(20) . time() . '.' . $image->extension();
                    $image->move(public_path('assets/cms/'), $newfile);

                    // Update image column with new file name
                    $advert->image = $newfile;
                }
                if ($advert->save()) {
                    return redirect()->route('admin.cms2')->with('success', 'Advert updated successfully');
                }

            }
            return back()->with('error', 'An error has occured');
        }
    }

    public function enable($id)
    {
        if ($advert = CarouselTwo::find($id)) {
            if ($advert->update(['status' => 1])) {
                return back()->with('success', 'Advert enabled and published ssuccessfully');
            }
        }
        return back()->with('error', 'AnAn error has occured');
    }
    public function disable($id)
    {
        if ($advert = CarouselTwo::find($id)) {
            if ($advert->update(['status' => 0])) {
                return back()->with('success', 'Advert disabled  ssuccessfully');
            }
        }
        return back()->with('error', 'AnAn error has occured');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if ($advert = CarouselTwo::find($id)) {
            $image = $advert->image;
            $path = public_path('assets/cms/' . $image);
            if (file_exists($path)) {
                unlink($path);
            }
            if ($advert->delete()) {
                return back()->with('success', 'Advert deleted  ssuccessfully');
            }
        }
        return back()->with('error', 'AnAn error has occured');
    }
}
