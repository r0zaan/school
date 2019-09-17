<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = [
        'name',
        'from',
        'to',
        'lunch',
        'classroom_id',
        'section_id',
    ];

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

}
