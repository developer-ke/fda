<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarouselOneRequest;
use App\Http\Requests\UpdateCarouselOneRequest;
use App\Models\CarouselOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CarouselOneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adverts = CarouselOne::join('users', 'carousel_ones.user_id', 'users.id')
            ->select(
                'users.name',
                'users.email',
                'users.image AS userImage',
                'carousel_ones.id',
                'carousel_ones.image',
                'carousel_ones.div_bg',
                'carousel_ones.header',
                'carousel_ones.header_color',
                'carousel_ones.body_text',
                'carousel_ones.body_text_color',
                'carousel_ones.btn_text',
                'carousel_ones.btn_color',
                'carousel_ones.btn_bg',
                'carousel_ones.url',
                'carousel_ones.status',
                'carousel_ones.created_at',
            )
            ->OrderBy('carousel_ones.id', 'desc')->get();
        return view('admin.carouselOne.index')->with('adverts', $adverts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.carouselOne.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarouselOneRequest $request)
    {
        if ($request->validated()) {
            $image = $request->file('image');
            $newfile = Str::random(20) . time() . '.' . $image->extension();
            $image->move(public_path('assets/cms/'), $newfile);
            $advert = new CarouselOne([
                'user_id' => Auth::user()->id,
                'div_bg' => $request->div_bg,
                'header' => $request->header,
                'header_color' => $request->header_color,
                'body_text' => $request->body_text,
                'body_text_color' => $request->body_text_color,
                'btn_text' => $request->btn_text,
                'btn_color' => $request->btn_text_color,
                'btn_bg' => $request->btn_bg,
                'url' => $request->url,
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
        if ($advert = CarouselOne::find($id)) {
            return view('admin.carouselOne.view')->with('advert', $advert);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if ($advert = CarouselOne::find($id)) {
            return view('admin.carouselOne.edit')->with('advert', $advert);
        }
        return back()->with('error', 'An error has occured');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarouselOneRequest $request, string $id)
    {
        if ($request->validated()) {
            if ($advert = CarouselOne::find($id)) {
                // Handle image upload if a new image is provided
                if ($request->hasFile('image')) {
                    // Delete old image file if it exists
                    $path = public_path('assets/cms/' . $advert->image);
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    // Process new image
                    $image = $request->file('image');
                    $newfile = Str::random(20) . time() . '.' . $image->extension();
                    $image->move(public_path('assets/cms/'), $newfile);

                    // Update image column with new file name
                    $advert->image = $newfile;
                }

                // Update other fields
                $advert->div_bg = $request->div_bg;
                $advert->header = $request->header;
                $advert->header_color = $request->header_color;
                $advert->body_text = $request->body_text;
                $advert->body_text_color = $request->body_text_color;
                $advert->btn_text = $request->btn_text;
                $advert->btn_color = $request->btn_text_color;
                $advert->btn_bg = $request->btn_bg;
                $advert->url = $request->url;
                if ($advert->save()) {
                    return redirect()->route('admin.cms1')->with('success', 'Advert updated successfully');
                }
            }
            return back()->with('error', 'An error has occured');
        }
    }

    public function enable($id)
    {
        if ($advert = CarouselOne::find($id)) {
            if ($advert->update(['status' => 1])) {
                return back()->with('success', 'Advert enabled and published ssuccessfully');
            }
        }
        return back()->with('error', 'AnAn error has occured');
    }
    public function disable($id)
    {
        if ($advert = CarouselOne::find($id)) {
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
        if ($advert = CarouselOne::find($id)) {
            $path = public_path('assets/cms/' . $advert->image);
            if (File::exists($path)) {
                File::delete($path);
            }
            if ($advert->delete()) {
                return back()->with('success', 'Advert deleted  ssuccessfully');
            }
        }
        return back()->with('error', 'AnAn error has occured');
    }

    public function enableAll()
    {
        try {
            // Start transaction
            DB::beginTransaction();
            // Update in chunks to avoid memory issues
            $chunkSize = 100; // Adjust this number based on your needs
            CarouselOne::chunk($chunkSize, function ($adverts) {
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
            CarouselOne::chunk($chunkSize, function ($adverts) {
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
            CarouselOne::chunk($chunkSize, function ($adverts) {
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
}