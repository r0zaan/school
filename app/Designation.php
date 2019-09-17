<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'department_id',
        'name',
        'teacher',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
