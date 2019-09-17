<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'code',
        'session_id',
        'classroom_id',
    ];

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }

    public function session(){
        return $this->belongsTo(Session::class);
    }
}
