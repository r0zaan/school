<?php

namespace App\Http\Controllers\Backend;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentInactiveController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('first_name','ASC')->where('status','Not-Active')->get();
        return view('backend.studentInactive.index',compact('students'));
    }
}
