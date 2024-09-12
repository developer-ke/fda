<?php

namespace App\Http\Controllers;

use App\Models\lostDocuments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MatchedDocumentsController extends Controller
{
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
            )->where('lost_documents.status', 2)->orderBy('lost_documents.id', 'DESC')->get();

        return view('admin.matchedDocuments.index')->with('documents', $documents);
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
        return view('admin.matchedDocuments.view')->with('document', $documents);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($document = lostDocuments::find($id)) {
            try {
                DB::beginTransaction();
                if ($document->delete()) {
                    DB::commit();
                    return back()->with('success', 'document deleted successfully');
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                Log::error('error due to' . $th->getMessage());
            }
        }
        return back()->with('error', 'an error has occured');
    }
    public function claimed(string $id)
    {
        if ($document = lostDocuments::find($id)) {
            try {
                DB::beginTransaction();
                if ($document->update(['status' => 2])) {
                    DB::commit();
                    return back()->with('success', 'document marked as claimed successfully');
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                Log::error('error due to' . $th->getMessage());
            }
        }
        return back()->with('error', 'an error has occured');
    }
}