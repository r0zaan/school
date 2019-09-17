<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentEmergencyContact extends Model
{
    protected $fillable = [
        'student_id',
        'name_of_contact',
        'address',
        'relationship',
        'telephone',
        'mobile',
    ];
}
