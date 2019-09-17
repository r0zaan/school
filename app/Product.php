<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'model_number',
        'price',
        'discount_percentage',
        'description',
        'brand_id',
        'group_id',
        'slug'
    ];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function colorImages(){
        return $this->hasMany(ColorImage::class);
    }
}
