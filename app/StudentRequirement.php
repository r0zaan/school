<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentRequirement extends Model
{
    protected $fillable = [
        'student_id',
        'food_service',
        'transport_service',
        'learning_disability',
        'other_requirement',
    ];
}
