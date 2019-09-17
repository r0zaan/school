<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentGuardian extends Model
{
    protected $fillable = [
        'student_id',
        'particular',
        'relationship',
        'name',
        'dob',
        'qualification',
        'occupation',
        'designation',
        'name_of_company',
        'work_location',
        'pan_no',
        'telephone_no',
        'mobile_no',
        'email',
    ];
}
