<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lostDocuments extends Model
{
    use HasFactory;
    protected $fillable = [
        "address",
        "phoneNumber",
        "code",
        "email",
        "firstName",
        "lastName",
        "police_ref_number",
        "location",
        "institution_on_document",
        "serialNumber",
        "country_id",
        "document_type_id",
        "status",
    ];
}
