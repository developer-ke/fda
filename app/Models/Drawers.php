<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drawers extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "institution_id",
        "document_type_id",
        "firstName",
        "secondName",
        "lastName",
        "serialNumber",
        "expiryDate",
        "status",
    ];
}
