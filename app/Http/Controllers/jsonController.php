<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class jsonController extends Controller
{
    public function index()
    {
        $drawers = DB::select('SELECT types.name AS documentType, drawers.document_type_id  FROM drawers INNER JOIN document_types AS types ON drawers.document_type_id = types.id');
        return response()->json([
            'success' => true,
            'drawers' => $drawers,
        ]);

    }
}
