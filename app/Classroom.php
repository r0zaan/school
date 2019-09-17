<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'name'
    ];


    public function sections(){
        return $this->hasMany(Section::class);
    }
}
