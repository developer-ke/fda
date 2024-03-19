<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class institution extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'correspondet_id',
        'country_id',
        'name',
        'logo',
        'phoneNumber',
        'altPhoneNumber',
        'email',
        'location',
        'address',
        'latitude',
        'longitude',
        'status',
    ];
}
