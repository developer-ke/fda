<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundDocuments extends Model
{
    use HasFactory;
    protected $fillable = [
        "document_type_id",
        "country_id",
        "serialNumber",
        "owner_fname",
        "owner_lname",
        "latitude",
        "longitude",
        "institution_on_document",
        "reprter_email",
        "reporter_code",
        "reporter_phoneNumber",
        "reporter_fname",
        "reporter_lname",
        "status",
    ];
}
