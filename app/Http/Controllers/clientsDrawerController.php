<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateDrawersRequest;
use App\Models\DocumentType;
use App\Models\Drawers;
use App\Models\institution;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class clientsDrawerController extends Controller
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
            )->where('drawers.user_id', '!=', Auth::user()->id)->orderBy('id', 'DESC')->get();
        switch (Auth::user()->role) {
            case 1:
                return view("admin.drawers.clients.index")->with('drawers', $drawers);
                break;
            case 2:
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
                    )->where('institutions.correspondet_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
                return view('correspondent.drawers.clients.index')->with('drawers', $drawers);
                break;
            default:
                return back()->with('error', 'An error has occured');
                break;
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
                        return view("admin.drawers.clients.view")->with('drawer', $drawers);
                        break;
                    case 2:
                        return view("correspondent.drawers.clients.view")->with('drawer', $drawers);
                        break;
                    default:
                        return back()->with('error', 'error occured');
                        break;
                }
            }
        } catch (Throwable $th) {
            Log::error($th);
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
                return view("admin.drawers.clients.edit")->with([
                    'drawer' => $drawer,
                    'institutions' => institution::orderBy('id', 'DESC')->get(),
                    'types' => DocumentType::orderBy('id', 'DESC')->get(),
                ]);
            }

        } catch (Exception $e) {
            Log::error('error due to', $e->getMessage());
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
            Log::error('error due to', $th->getMessage());
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
            Log::error('error', $th->getMessage());
            return back()->with('error', 'an error occured');
        }
    }
}
