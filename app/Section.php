<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'name',
        'classroom_id',
    ];


    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }
}
