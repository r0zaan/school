<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorImage extends Model
{
    protected $fillable = [
        'product_id',
        'image',
        'color_name',
        'color_code',
        'quantity',
    ];
}
