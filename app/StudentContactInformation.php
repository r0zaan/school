<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentContactInformation extends Model
{
    protected $fillable = [
        'student_id',
        'residential_address',
        'city',
        'zip_code',
        'land_mark',
        'state',
        'telephone',
    ];

}
