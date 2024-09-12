<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentTypeRequest;
use App\Http\Requests\UpdateDocumentTypeRequest;
use App\Models\DocumentType;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentTypes = DocumentType::join('users', 'document_types.user_id', 'users.id')
            ->select(
                'document_types.id',
                'document_types.name',
                'document_types.created_at',
                'users.name AS username',
                'users.email',
                'users.image'
            )->OrderBy('document_types.id', 'DESC')->get();
        return view('admin.documentTypes.index')->with('documents', $documentTypes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.documentTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentTypeRequest $request)
    {
        try {
            DB::beginTransaction();
            if ($request->validated()) {
                $document = DocumentType::create([
                    'user_id' => Auth::user()->id,
                    'name' => $request->name,
                ]);
                if ($document->save()) {
                    DB::commit();
                    return back()->with('success', 'type of document added successfully');
                }
                return back()->with('error', 'an error occured');
            }
        } catch (Exception $e) {
            DB::rollback();
            Log::error('error due to ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            if ($document = DocumentType::find($id)) {
                return view('admin.documentTypes.edit')->with('document', $document);
            }
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('error occured due to' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentTypeRequest $request, $id)
    {
        try {
            if ($request->validated()) {
                DB::beginTransaction();
                if ($document = DocumentType::find($id)) {
                    if ($document->update([
                        'user_id' => Auth::user()->id,
                        'name' => $request->name,
                    ])) {
                        DB::commit();
                        return redirect()->route('admin.documentTypes')->with('success', 'document type updated successfully');
                    }
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('error' . $th->getMessage());
            return back()->with('error', 'an error has occured');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            if ($document = DocumentType::find($id)) {
                if ($document->delete()) {
                    DB::commit();
                    return redirect()->route('admin.documentTypes')->with('success', 'document type updated successfully');
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('error' . $th->getMessage());
            return back()->with('error', 'an error has occured');
        }
    }
}