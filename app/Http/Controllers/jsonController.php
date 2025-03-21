<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class jsonController extends Controller
{
    public function index()
    {
        $drawers = DB::select('SELECT types.name AS documentType, drawers.document_type_id  FROM drawers INNER JOIN document_types AS types ON drawers.document_type_id = types.id');
        return response()->json([
            'success' => true,
            'drawers' => $drawers,
            'users' => User::all(),
        ]);
    }
    public function users()
    {
        $users = User::orderBy('id', 'DESC');
        return DataTables::queryBuilder($users)->toJson();
    }
}
