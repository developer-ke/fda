<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselOne extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'div_bg',
        'header',
        'header_color',
        'body_text',
        'body_text_color',
        'btn_text',
        'btn_color',
        'btn_bg',
        'url',
        'status',
        'image',
    ];
}
