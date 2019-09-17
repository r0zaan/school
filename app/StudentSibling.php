<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSibling extends Model
{
    protected $fillable = [
        'student_id',
        'name',
        'age',
        'education',
        'school',
    ];
}
