<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentLastAttend extends Model
{
    protected $fillable = [
        'student_id',
        'name_of_school',
        'board',
        'percentage',
        'address',
        'city',
        'zip_code',
        'state',
        'telephone',
        'reason',
    ];
}
