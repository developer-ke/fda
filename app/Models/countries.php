<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class countries extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'abbreviation',
        'name',
        'city',
        'user_id',
        'nationality',
    ];
}