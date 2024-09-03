<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFoundDocumentsRequest;
use App\Http\Requests\UpdateFoundDocumentsRequest;
use App\Mail\foundNotification;
use App\Models\countries;
use App\Models\DocumentType;
use App\Models\FoundDocuments;
use App\Models\lostDocuments;
use App\Models\Profile;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FoundDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = FoundDocuments::join('document_types', 'found_documents.document_type_id', 'document_types.id')
            ->join('countries', 'found_documents.country_id', 'countries.id')
            ->select([
                "found_documents.id",
                "found_documents.serialNumber",
                "found_documents.owner_fname",
                "found_documents.owner_lname",
                "found_documents.latitude",
                "found_documents.longitude",
                "found_documents.institution_on_document",
                "found_documents.reprter_email",
                "found_documents.reporter_code",
                "found_documents.reporter_phoneNumber",
                "found_documents.reporter_fname",
                "found_documents.reporter_lname",
                "found_documents.status",
                "found_documents.created_at",
                "document_types.name AS typOfDocument",
                "countries.name AS countryName",
                "countries.city",
            ])->OrderBy('found_documents.id', 'DESC')->get();
        switch (Auth::user()->role) {
            case 1:
                return view('admin.foundDocuments.index')->with('documents', $documents);
            case 2:
                $documents = FoundDocuments::join('document_types', 'found_documents.document_type_id', 'document_types.id')
                    ->join('countries', 'found_documents.country_id', 'countries.id')
                    ->select([
                        "found_documents.id",
                        "found_documents.serialNumber",
                        "found_documents.owner_fname",
                        "found_documents.owner_lname",
                        "found_documents.latitude",
                        "found_documents.longitude",
                        "found_documents.institution_on_document",
                        "found_documents.reprter_email",
                        "found_documents.reporter_code",
                        "found_documents.reporter_phoneNumber",
                        "found_documents.reporter_fname",
                        "found_documents.reporter_lname",
                        "found_documents.status",
                        "found_documents.created_at",
                        "document_types.name AS typOfDocument",
                        "countries.name AS countryName",
                        "countries.city",
                    ])->where('found_documents.reprter_email', Auth::user()->email)->OrderBy('found_documents.id', 'DESC')->get();
                return view('correspondent.foundDocuments.index')->with('documents', $documents);

            case 3:
                $documents = FoundDocuments::join('document_types', 'found_documents.document_type_id', 'document_types.id')
                    ->join('countries', 'found_documents.country_id', 'countries.id')
                    ->select([
                        "found_documents.id",
                        "found_documents.serialNumber",
                        "found_documents.owner_fname",
                        "found_documents.owner_lname",
                        "found_documents.latitude",
                        "found_documents.longitude",
                        "found_documents.institution_on_document",
                        "found_documents.reprter_email",
                        "found_documents.reporter_code",
                        "found_documents.reporter_phoneNumber",
                        "found_documents.reporter_fname",
                        "found_documents.reporter_lname",
                        "found_documents.status",
                        "found_documents.created_at",
                        "document_types.name AS typOfDocument",
                        "countries.name AS countryName",
                        "countries.city",
                    ])->where('found_documents.reprter_email', Auth::user()->email)->OrderBy('found_documents.id', 'DESC')->get();
                return view('subscriber.foundDocuments.index')->with('documents', $documents);

            default:
                return back()->with('error', 'error occured');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Profile::join('countries', 'profiles.country_id', 'countries.id')->select(
            'countries.code',
            'profiles.phoneNumber'
        )->where('profiles.user_id', Auth::user()->id)->first();
        switch (Auth::user()->role) {
            case 1:
                return view('admin.foundDocuments.create')->with([
                    'types' => DocumentType::all(),
                    'countries' => countries::all(),
                    'user' => $user,
                ]);

            case 2:
                return view('correspondent.foundDocuments.create')->with([
                    'types' => DocumentType::all(),
                    'countries' => countries::all(),
                    'user' => $user,
                ]);

            case 3:
                return view('subscriber.foundDocuments.create')->with([
                    'types' => DocumentType::all(),
                    'countries' => countries::all(),
                    'user' => $user,
                ]);


            default:
                return back()->with('error', 'an error occured');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoundDocumentsRequest $request)
    {
        if ($request->validated()) {
            try {
                DB::beginTransaction();
                // get the document from the lost documents
                $status = 0;
                if ($document = lostDocuments::where('serialNumber', $request->document_serial_number)->first()) {
                    // get the owner's details if it's found
                    $fname = $document->firstName;
                    $lname = $document->lastName;
                    $email = $document->email;
                    if ($fname == $request->Owners_first_name && $lname == $request->Owners_last_name || $lname == $request->Owners_first_name && $fname == $request->Owners_last_name) {
                        if (Mail::to($email)->send(new foundNotification($request->all()))) {
                            $document->update(['status' => 2]);
                            $status = 2;
                        }
                    }
                }
                $document = new FoundDocuments([
                    "document_type_id" => $request->document_type_id,
                    "country_id" => $request->country_id,
                    "serialNumber" => $request->document_serial_number,
                    "owner_fname" => $request->Owners_first_name,
                    "owner_lname" => $request->Owners_last_name,
                    "latitude" => $request->latitude,
                    "longitude" => $request->longitude,
                    "institution_on_document" => $request->institution_on_doc,
                    "reprter_email" => $request->email_address,
                    "reporter_code" => $request->fcountrycode,
                    "reporter_phoneNumber" => $request->phone_number,
                    "reporter_fname" => $request->ffirst_name,
                    "reporter_lname" => $request->flast_name,
                    "status" => $status,
                ]);
                if ($document->save()) {
                    DB::commit();
                    return back()->with('success', 'document reported successfully');
                }
            } catch (Exception $e) {
                DB::rollBack();
                Log::error($e);
                return back()->with('error', 'error occured');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (FoundDocuments::find($id)) {
            $documents = FoundDocuments::join('document_types', 'found_documents.document_type_id', 'document_types.id')
                ->join('countries', 'found_documents.country_id', 'countries.id')
                ->select([
                    "found_documents.id",
                    "found_documents.serialNumber",
                    "found_documents.owner_fname",
                    "found_documents.owner_lname",
                    "found_documents.latitude",
                    "found_documents.longitude",
                    "found_documents.institution_on_document",
                    "found_documents.reprter_email",
                    "found_documents.reporter_code",
                    "found_documents.reporter_phoneNumber",
                    "found_documents.reporter_fname",
                    "found_documents.reporter_lname",
                    "found_documents.status",
                    "found_documents.created_at",
                    "document_types.name AS typOfDocument",
                    "countries.name AS countryName",
                    "countries.city",
                ])->where('found_documents.id', $id)->OrderBy('found_documents.id', 'DESC')->first();
            switch (Auth::user()->role) {
                case 1:
                    return view('admin.foundDocuments.view')->with('document', $documents);

                case 2:
                    return view('correspondent.foundDocuments.view')->with('document', $documents);

                case 3:
                    return view('subscriber.foundDocuments.view')->with('document', $documents);

                default:
                    return back()->with('error', 'error occured');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if ($document = FoundDocuments::find($id)) {
            switch (Auth::user()->role) {
                case 1:
                    return view('admin.foundDocuments.edit')->with([
                        'document' => $document,
                        'types' => DocumentType::all(),
                        'countries' => countries::all(),
                    ]);

                case 2:
                    return view('correspondent.foundDocuments.edit')->with([
                        'document' => $document,
                        'types' => DocumentType::all(),
                        'countries' => countries::all(),
                    ]);

                case 3:
                    return view('subscriber.foundDocuments.edit')->with([
                        'document' => $document,
                        'types' => DocumentType::all(),
                        'countries' => countries::all(),
                    ]);

                default:
                    return back()->with('error', 'an error occured');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoundDocumentsRequest $request, string $id)
    {
        if ($document = FoundDocuments::find($id)) {
            try {
                DB::beginTransaction();
                if ($request->validated()) {
                    if ($document->update([
                        "document_type_id" => $request->document_type_id,
                        "country_id" => $request->country_id,
                        "serialNumber" => $request->document_serial_number,
                        "owner_fname" => $request->Owners_first_name,
                        "owner_lname" => $request->Owners_last_name,
                        "latitude" => $request->latitude,
                        "longitude" => $request->longitude,
                        "institution_on_document" => $request->institution_on_doc,
                        "reprter_email" => $request->email_address,
                        "reporter_code" => $request->fcountrycode,
                        "reporter_phoneNumber" => $request->phone_number,
                        "reporter_fname" => $request->ffirst_name,
                        "reporter_lname" => $request->flast_name,
                    ])) {
                        DB::commit();
                        return back()->with('success', 'document updated successfully');
                    }
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                Log::error($th);
                return back()->with('error', 'an error occured');
            }
        }
        //
    }

    public function match(string $id)
    {
        try {
            DB::beginTransaction();
            if ($document = FoundDocuments::find($id)) {
                if ($document->update(['status' => 2])) {
                    DB::commit();
                    return back()->with('success', 'document marked as matched successfully');
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return back()->with('error', 'an error has occured');
        }
    }
    public function claim(string $id)
    {
        try {
            DB::beginTransaction();
            if ($document = FoundDocuments::find($id)) {
                if ($document->update(['status' => 3])) {
                    DB::commit();
                    return back()->with('success', 'document marked as claimed successfully');
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return back()->with('error', 'an error has occured');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            if ($document = FoundDocuments::find($id)) {
                if ($document->delete()) {
                    DB::commit();
                    return back()->with('success', 'document deleted successfully');
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return back()->with('error', 'an error has occured');
        }
    }
}