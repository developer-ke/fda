<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDrawersRequest;
use App\Http\Requests\UpdateDrawersRequest;
use App\Models\DocumentType;
use App\Models\Drawers;
use App\Models\institution;
use App\Models\lostDocuments;
use App\Models\Profile;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;
use Biscolab\ReCaptcha\Facades\ReCaptcha;

class DrawersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drawers = Drawers::join('users', 'users.id', 'drawers.user_id')
            ->join('institutions', 'drawers.institution_id', 'institutions.id')
            ->join('document_types', 'drawers.document_type_id', 'document_types.id')
            ->select(
                'users.name AS username',
                'users.email',
                'users.image',
                'institutions.name AS institutionName',
                'institutions.email AS institutionEmail',
                'institutions.phoneNumber',
                'institutions.address',
                'document_types.name AS documentType',
                "drawers.id",
                "drawers.firstName",
                "drawers.secondName",
                "drawers.lastName",
                "drawers.serialNumber",
                "drawers.expiryDate",
                "drawers.status",
                "drawers.created_at"
            )->where('drawers.user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        switch (Auth::user()->role) {
            case 1:
                return view("admin.drawers.mydrawer.index")->with('drawers', $drawers);
            case 2:
                return view("correspondent.drawers.mydrawer.index")->with('drawers', $drawers);

            case 3:
                return view("subscriber.drawer.index")->with('drawers', $drawers);

            default:
                return back()->with('error', 'error occured');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        switch (Auth::user()->role) {
            case 1:
                return view("admin.drawers.mydrawer.create")->with([
                    'institutions' => institution::orderBy('name', 'ASC')->get(),
                    'types' => DocumentType::orderBy('name', 'ASC')->get(),
                ]);

            case 2:
                return view("correspondent.drawers.mydrawer.create")->with([
                    'institutions' => institution::orderBy('name', 'ASC')->get(),
                    'types' => DocumentType::orderBy('name', 'ASC')->get(),
                ]);

            case 3:
                return view("subscriber.drawer.create")->with([
                    'institutions' => institution::orderBy('name', 'ASC')->get(),
                    'types' => DocumentType::orderBy('name', 'ASC')->get(),
                ]);

            default:
                return back()->with('error', 'error occured');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDrawersRequest $request)
    {
        try {
            $recaptcha = ReCaptcha::validate($request->input('g-recaptcha-response'));

            if (!$recaptcha) {
                return back()->withErrors(['captcha' => 'Captcha verification failed. Please try again.']);
            }
            DB::beginTransaction();
            if ($request->validated()) {
                $drawer = Drawers::create([
                    "user_id" => Auth::user()->id,
                    "institution_id" => $request->institution,
                    "document_type_id" => $request->documentType,
                    "firstName" => $request->firstName,
                    "secondName" => $request->secondName,
                    "lastName" => $request->lastName,
                    "serialNumber" => $request->serialNumber,
                    "expiryDate" => $request->expiryDate,
                ]);
                if ($drawer->save()) {
                    DB::commit();
                    return back()->with("success", "document added to the drawer successfully");
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            Log::error('error' . $e->getMessage());
            return back()->with('error', 'an error occured');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            if (Drawers::find($id)) {
                $drawers = Drawers::join('users', 'users.id', 'drawers.user_id')
                    ->join('institutions', 'drawers.institution_id', 'institutions.id')
                    ->join('document_types', 'drawers.document_type_id', 'document_types.id')
                    ->select(
                        'users.name AS username',
                        'users.email',
                        'users.image',
                        'institutions.name AS institutionName',
                        'institutions.email AS institutionEmail',
                        'institutions.phoneNumber',
                        'institutions.address',
                        'document_types.name AS documentType',
                        "drawers.id",
                        "drawers.firstName",
                        "drawers.secondName",
                        "drawers.lastName",
                        "drawers.serialNumber",
                        "drawers.expiryDate",
                        "drawers.status",
                        "drawers.created_at"
                    )->where('drawers.id', $id)->first();
                switch (Auth::user()->role) {
                    case 1:
                        return view("admin.drawers.mydrawer.view")->with('drawer', $drawers);

                    case 2:
                        return view("correspondent.drawers.mydrawer.view")->with('drawer', $drawers);

                    case 3:
                        return view("subscriber.drawer.view")->with('drawer', $drawers);
                    default:
                        return back()->with('error', 'error occured');
                }
            }
        } catch (Throwable $th) {
            Log::error('error due to' . $th->getMessage());
            return back()->with('error', 'error occured');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            if ($drawer = Drawers::find($id)) {
                switch (Auth::user()->role) {
                    case 1:
                        return view("admin.drawers.mydrawer.edit")->with([
                            'drawer' => $drawer,
                            'institutions' => institution::orderBy('id', 'DESC')->get(),
                            'types' => DocumentType::orderBy('id', 'DESC')->get(),
                        ]);

                    case 2:
                        return view("correspondent.drawers.mydrawer.edit")->with([
                            'drawer' => $drawer,
                            'institutions' => institution::orderBy('id', 'DESC')->get(),
                            'types' => DocumentType::orderBy('id', 'DESC')->get(),
                        ]);

                    case 3:
                        return view("subscriber.drawer.edit")->with([
                            'drawer' => $drawer,
                            'institutions' => institution::orderBy('id', 'DESC')->get(),
                            'types' => DocumentType::orderBy('id', 'DESC')->get(),
                        ]);


                    default:
                        return back()->with('error', 'error occured');
                }
            }
        } catch (Exception $e) {
            Log::error('error due to ' . $e->getMessage());
            return back()->with('error', 'error occured');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDrawersRequest $request, string $id)
    {
        try {
            if ($drawer = Drawers::find($id)) {
                DB::beginTransaction();
                if ($drawer->update([
                    "user_id" => Auth::user()->id,
                    "institution_id" => $request->institution,
                    "document_type_id" => $request->documentType,
                    "firstName" => $request->firstName,
                    "secondName" => $request->secondName,
                    "lastName" => $request->lastName,
                    "serialNumber" => $request->serialNumber,
                    "expiryDate" => $request->expiryDate,
                ])) {
                    DB::commit();
                    return back()->with('success', 'document details updated successfully');
                }
            }
        } catch (Throwable $th) {
            DB::rollBack();
            Log::error('error due to ' . $th->getMessage());
            return back()->with('error', 'error occured');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            if ($drawer = Drawers::find($id)) {
                DB::beginTransaction();
                if ($drawer->delete()) {
                    DB::commit();
                    return back()->with('success', 'document deleted from drawer successfully');
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('error ' . $th->getMessage());
            return back()->with('error', 'an error occured');
        }
    }

    public function clientsDrawer()
    {

        $drawers = Drawers::join('users', 'users.id', 'drawers.user_id')
            ->join('institutions', 'drawers.institution_id', 'institutions.id')
            ->join('document_types', 'drawers.document_type_id', 'document_types.id')
            ->select(
                'users.name AS username',
                'users.email',
                'users.image',
                'institutions.name AS institutionName',
                'institutions.email AS institutionEmail',
                'institutions.phoneNumber',
                'institutions.address',
                'document_types.name AS documentType',
                "drawers.id",
                "drawers.firstName",
                "drawers.secondName",
                "drawers.lastName",
                "drawers.serialNumber",
                "drawers.expiryDate",
                "drawers.status",
                "drawers.created_at"
            )->where('drawers.user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view("admin.drawers.mydrawer.index")->with('drawers', $drawers);
    }

    public function lost(string $id)
    {
        if ($drawer = Drawers::find($id)) {
            try {
                $userId = $drawer->user_id;
                $user = Profile::join('countries', 'profiles.country_id', 'countries.id')
                    ->select(
                        "countries.id",
                        "countries.code",
                        "profiles.phoneNumber",
                        "profiles.physicalAddress",
                    )->where('profiles.user_id', $userId)->first();
                DB::beginTransaction();
                $lost = new lostDocuments([
                    "address" => $user->physicalAddress,
                    "phoneNumber" => $user->phoneNumber,
                    "code" => $user->code,
                    "email" => Auth::user()->email,
                    "firstName" => explode(' ', Auth::user()->name)[0],
                    "lastName" => explode(' ', Auth::user()->name)[1],
                    "serialNumber" => $drawer->serialNumber,
                    "country_id" => $user->id,
                    "document_type_id" => $drawer->document_type_id,
                ]);
                if ($lost->save()) {
                    $drawer->update(['status' => 0]);
                    DB::commit();
                    return back()->with('success', 'document reported as lost successfully');
                }
            } catch (Throwable $e) {
                DB::rollBack();
                dd($e->getMessage());
                Log::error($e->getMessage());
                return back()->with('error', 'an error occured');
            }
        }
        return back()->with('error', 'an error occurred');
    }
    public function found(string $id)
    {
        try {
            DB::beginTransaction();
            if ($drawer = Drawers::find($id)) {
                if ($document = lostDocuments::where('serialNumber', $drawer->serialNumber)->first()) {
                    if ($document->delete()) {
                        if ($drawer->update(['status' => 1])) {
                            DB::commit();
                            return back()->with('success', 'document reported as found successfully');
                        }
                    }
                }
                return back()->with('error', 'associated document not found');
            }
            return back()->with('error', 'documents not found');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return back()->with('error', 'error occured');
        }
    }
}