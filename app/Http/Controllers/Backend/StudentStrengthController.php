<?php

namespace App\Http\Controllers\Backend;

use App\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentStrengthController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::orderBy('name', 'ASC')
            ->with(['sections', 'sections.students'=> function($query){
                return $query->where('status','Active');
            }])
            ->get()
            ->map(function ($classroom) {
                $classroom['sections_count'] = $classroom->sections()->count();
                return $classroom;
       });
        $femaleCount = Classroom::with(['sections','sections.students' => function($query){
            return $query->where('gender','Female')->where('status','Active');
        }])->get()->pluck('sections')->collapse()->pluck('students')->collapse()->count();
        $maleCount = Classroom::with(['sections','sections.students' => function($query){
            return $query->where('gender','Male')->where('status','Active');
        }])->get()->pluck('sections')->collapse()->pluck('students')->collapse()->count();
        return view('backend.studentStrength.index', compact('classrooms','femaleCount','maleCount'));
    }
}
