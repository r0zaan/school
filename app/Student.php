<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'admission_number',
        'ec_number',
        'first_name',
        'middle_name',
        'last_name',
        'classroom_id',
        'section_id',
        'session_id',
        'dob',
        'place_of_birth',
        'gender',
        'religion',
        'student_category_id',
        'student_uid',
        'mother_tongue',
        'blood_group',
        'image',
        'agreement',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function session(){
        return $this->belongsTo(Session::class);
    }
    public function studentCategory(){
        return $this->belongsTo(StudentCategory::class);
    }
    public function studentContactInformation(){
        return $this->hasOne(StudentContactInformation::class);
    }
    public function studentEmergencyContact(){
        return $this->hasOne(StudentEmergencyContact::class);
    }
    public function studentLastAttend(){
        return $this->hasOne(StudentLastAttend::class);
    }
    public function studentRequirement(){
        return $this->hasOne(StudentRequirement::class);
    }
    public function studentSiblings(){
        return $this->hasMany(StudentSibling::class);
    }
    public function studentGuardians(){
        return $this->hasMany(StudentGuardian::class);
    }
    public function attendances(){
        return $this->hasMany(Attendance::class);
    }


    public function fullName(){
        if($this->middle_name == null || $this->middle_name == " "){
            return $this->first_name.' '.$this->last_name;
        }
        else{
            return $this->first_name.' '.$this->middle_name.' '.$this->last_name;
        }
    }
}
