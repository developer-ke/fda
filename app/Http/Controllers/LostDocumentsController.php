<?php

namespace App\Http\Controllers;

use App\Services\ApollosSmsService;
use App\Http\Requests\StorelostDocumentsRequest;
use App\Http\Requests\UpdatelostDocumentsRequest;
use App\Models\countries;
use App\Models\DocumentType;
use App\Models\FoundDocuments;
use App\Models\lostDocuments;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\foundNotification;
use Illuminate\Support\Facades\Mail;
use Biscolab\ReCaptcha\Facades\ReCaptcha;

class LostDocumentsController extends Controller
{
    protected $smsService;

    public function __construct(ApollosSmsService $smsService)
    {
        $this->smsService = $smsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = lostDocuments::join('countries', 'lost_documents.country_id', 'countries.id')
            ->join('document_types', 'lost_documents.document_type_id', 'document_types.id')
            ->select(
                "lost_documents.id",
                "lost_documents.address",
                "lost_documents.phoneNumber",
                "lost_documents.code",
                "lost_documents.email",
                "lost_documents.firstName",
                "lost_documents.lastName",
                "lost_documents.police_ref_number",
                "lost_documents.location",
                "lost_documents.institution_on_document",
                "lost_documents.serialNumber",
                "lost_documents.status",
                "lost_documents.created_at",
                "countries.name as countryName",
                "countries.city",
                "document_types.name AS documentType"
            )->where('lost_documents.status', 0)->orderBy('lost_documents.id', 'DESC')->get();
        switch (Auth::user()->role) {
            case 1:
                return view('admin.lostDocuments.index')->with('documents', $documents);

            case 2:
                $documents = lostDocuments::join('countries', 'lost_documents.country_id', 'countries.id')
                    ->join('document_types', 'lost_documents.document_type_id', 'document_types.id')
                    ->select(
                        "lost_documents.id",
                        "lost_documents.address",
                        "lost_documents.phoneNumber",
                        "lost_documents.code",
                        "lost_documents.email",
                        "lost_documents.firstName",
                        "lost_documents.lastName",
                        "lost_documents.police_ref_number",
                        "lost_documents.location",
                        "lost_documents.institution_on_document",
                        "lost_documents.serialNumber",
                        "lost_documents.status",
                        "lost_documents.created_at",
                        "countries.name as countryName",
                        "countries.city",
                        "document_types.name AS documentType"
                    )->where(['lost_documents.status' => 0, 'lost_documents.email' => Auth::user()->email])->orderBy('lost_documents.id', 'DESC')->get();
                return view('correspondent.lostDocuments.index')->with('documents', $documents);


            case 3:
                $documents = lostDocuments::join('countries', 'lost_documents.country_id', 'countries.id')
                    ->join('document_types', 'lost_documents.document_type_id', 'document_types.id')
                    ->select(
                        "lost_documents.id",
                        "lost_documents.address",
                        "lost_documents.phoneNumber",
                        "lost_documents.code",
                        "lost_documents.email",
                        "lost_documents.firstName",
                        "lost_documents.lastName",
                        "lost_documents.police_ref_number",
                        "lost_documents.location",
                        "lost_documents.institution_on_document",
                        "lost_documents.serialNumber",
                        "lost_documents.status",
                        "lost_documents.created_at",
                        "countries.name as countryName",
                        "countries.city",
                        "document_types.name AS documentType"
                    )->where(['lost_documents.status' => 0, 'lost_documents.email' => Auth::user()->email])->orderBy('lost_documents.id', 'DESC')->get();
                return view('subscriber.lostDocuments.index')->with('documents', $documents);

            default:
                return back()->with('error', 'error occured');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::join('profiles', 'users.id', 'profiles.user_id')
            ->join('countries', 'profiles.country_id', 'countries.id')
            ->select(
                "users.name",
                "users.email",
                "countries.code",
                "profiles.physicalAddress",
                'profiles.phoneNumber',
            )->where('profiles.user_id', Auth::user()->id)->first();
        switch (Auth::user()->role) {
            case 1:
                return view('admin.lostDocuments.create')->with([
                    'countries' => countries::orderBy('name', 'ASC')->get(),
                    'types' => DocumentType::orderBy('name', 'ASC')->get(),
                    'user' => $user,
                ]);



            case 2:
                return view('correspondent.lostDocuments.create')->with([
                    'countries' => countries::orderBy('name', 'ASC')->get(),
                    'types' => DocumentType::orderBy('name', 'ASC')->get(),
                    'user' => $user,
                ]);


            case 3:
                return view('subscriber.lostDocuments.create')->with([
                    'countries' => countries::orderBy('name', 'ASC')->get(),
                    'types' => DocumentType::orderBy('name', 'ASC')->get(),
                    'user' => $user,
                ]);


            default:
                return back()->with('error', 'An error has occured');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorelostDocumentsRequest $request)
    {

        if ($request->validated()) {

            $recaptcha = ReCaptcha::validate($request->input('g-recaptcha-response'));

            if (!$recaptcha) {
                return back()->withErrors(['captcha' => 'Captcha verification failed. Please try again.']);
            }
            try {
                DB::beginTransaction();
                $status = 2;
                if ($document = FoundDocuments::where('serialNumber', $request->document_serial_number)->first()) {
                    // get the owner's details if it's found
                    $fname = $document->firstName;
                    $lname = $document->lastName;
                    $email = $document->email;
                    if ($fname == $request->fname && $lname == $request->lname || $lname == $request->lname && $fname == $request->fname) {
                        if (Mail::to($email)->send(new foundNotification($request->all()))) {

                            // send the sms at the same time
                            $messages = [
                                [
                                    'message' => 'The document that was reported as lost has been found. Please visit ' . env('APP_URL') . ' and get in touch.',
                                    'phoneNumber' => $request->lcountrycode . $request->lphone_number,
                                ]
                            ];

                            // send an SMS
                            $response = $this->smsService->sendSms($messages);

                            Log::info($response);
                            $document->update(['status' => 2]);
                            $status = 2;
                        }
                    }
                }
                $lost = new lostDocuments([
                    "address" => $request->return_address,
                    "phoneNumber" => $request->lphone_number,
                    "code" => $request->lcountrycode,
                    "email" => $request->email_address,
                    "firstName" => $request->fname,
                    "lastName" => $request->lname,
                    "police_ref_number" => $request->police_refNo,
                    "location" => $request->locationLost,
                    "institution_on_document" => $request->institution_on_doc,
                    "serialNumber" => $request->document_serial_number,
                    "country_id" => $request->country_id,
                    "document_type_id" => $request->document_type_id,
                    'status' => $status,
                ]);
                if ($lost->save()) {
                    DB::commit();
                    return back()->with('success', 'document reported as lost successfully');
                }
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('error' . $e->getMessage());
                return back()->with('error', 'an error occured');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $documents = lostDocuments::join('countries', 'lost_documents.country_id', 'countries.id')
            ->join('document_types', 'lost_documents.document_type_id', 'document_types.id')
            ->select(
                "lost_documents.id",
                "lost_documents.address",
                "lost_documents.phoneNumber",
                "lost_documents.code",
                "lost_documents.email",
                "lost_documents.firstName",
                "lost_documents.lastName",
                "lost_documents.police_ref_number",
                "lost_documents.location",
                "lost_documents.institution_on_document",
                "lost_documents.serialNumber",
                "lost_documents.status",
                "lost_documents.created_at",
                "countries.name as countryName",
                "countries.city",
                "document_types.name AS documentType"
            )->where('lost_documents.id', $id)->first();
        switch (Auth::user()->role) {
            case 1:
                return view('admin.lostDocuments.view')->with('document', $documents);

            case 2:
                return view('correspondent.lostDocuments.view')->with('document', $documents);

            case 3:
                return view('subscriber.lostDocuments.view')->with('document', $documents);

            default:
                return back()->with('error', 'An error has occured');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if ($document = lostDocuments::find($id)) {
            switch (Auth::user()->role) {
                case 1:
                    return view('admin.lostDocuments.edit')->with([
                        'document' => $document,
                        'countries' => countries::orderBy('name', 'ASC')->get(),
                        'types' => DocumentType::orderBy('name', 'ASC')->get(),
                    ]);

                case 2:
                    return view('correspondent.lostDocuments.edit')->with([
                        'document' => $document,
                        'countries' => countries::orderBy('name', 'ASC')->get(),
                        'types' => DocumentType::orderBy('name', 'ASC')->get(),
                    ]);

                case 3:
                    return view('subscriber.lostDocuments.edit')->with([
                        'document' => $document,
                        'countries' => countries::orderBy('name', 'ASC')->get(),
                        'types' => DocumentType::orderBy('name', 'ASC')->get(),
                    ]);


                default:
                    return back()->with('error', 'an error has occured');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelostDocumentsRequest $request, string $id)
    {
        if ($request->validated()) {
            if ($document = lostDocuments::find($id)) {
                try {
                    DB::beginTransaction();
                    if ($document->update([
                        "address" => $request->return_address,
                        "phoneNumber" => $request->lphone_number,
                        "code" => $request->lcountrycode,
                        "email" => $request->email_address,
                        "firstName" => $request->fname,
                        "lastName" => $request->lname,
                        "police_ref_number" => $request->police_refNo,
                        "location" => $request->locationLost,
                        "institution_on_document" => $request->institution_on_doc,
                        "serialNumber" => $request->document_serial_number,
                        "country_id" => $request->country_id,
                        "document_type_id" => $request->document_type_id,
                    ])) {
                        DB::commit();
                        return back()->with('success', 'document updated successfully');
                    }
                } catch (\Throwable $th) {
                    Log::error('error due to' . $th->getMessage());
                    DB::rollBack();
                }
            }
            return back()->with('error', 'error occured');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            if ($document = lostDocuments::find($id)) {
                if ($document->delete()) {
                    DB::commit();
                    return back()->with('success', 'Document deleted successfully');
                }
            }
            return back()->with('error', 'an error has occured');
        } catch (\Throwable $th) {
            Log::error('error due to' . $th->getMessage());
            DB::rollBack();
            return back()->with('error', 'an error has occured');
        }
    }

    // make a document as matched
    public function match(String $id)
    {
        try {
            DB::beginTransaction();
            if ($document = lostDocuments::find($id)) {
                if ($document->update(['status' => 2])) {
                    DB::commit();
                    return back()->with('success', 'Document marked as matched');
                }
            }
            return back()->with('error', 'an error has occured');
        } catch (\Throwable $th) {
            Log::error('error failed to fetch the lost document due to' . $th->getMessage());
            DB::rollBack();
            return back()->with('error', 'an error has occured');
        }
    }
    // make a document as matched
    public function claimed(String $id)
    {
        try {
            DB::beginTransaction();
            if ($document = lostDocuments::find($id)) {
                if ($document->update(['status' => 1])) {
                    DB::commit();
                    return back()->with('success', 'Document marked as claimed');
                }
            }
            return back()->with('error', 'an error has occured');
        } catch (\Throwable $th) {
            Log::error('error failed to fetch the lost document due to' . $th->getMessage());
            DB::rollBack();
            return back()->with('error', 'an error has occured');
        }
    }
}
