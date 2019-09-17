<?php

namespace App\Http\Controllers\Backend;

use App\Classroom;
use App\Http\Controllers\Controller;
use App\Section;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassPromotionController extends Controller
{
    public function index(){
        $classrooms = Classroom::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.classPromotion.create',compact('classrooms'));
    }
    public function getSections(Classroom $classroom){
        $sections = $classroom->sections()->get();
        return $sections;
    }
    public function getStudents(Section $section){
        $students = $section->students()->where('status','Active')
            ->orderBy('ec_number','ASC')
            ->get()
            ->map(function ($student){
            $student['name'] = $student->fullName();
            return $student;
        });
        return $students;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'classroom_id' => 'required',
            'section_id' => 'required',
            'student_id' => 'required',
            'promotion_classroom_id' => 'required',
            'promotion_section_id' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        $inputs = $request->all();
        foreach($inputs['student_id'] as $student_id){
            Student::find($student_id)->update([
              'classroom_id' => $inputs['promotion_classroom_id'] ,
              'section_id' => $inputs['promotion_section_id'] ,
            ]);
        }
        session()->flash('success', 'Student Promoted.');
        return [
            'status' => 'success',
            'return_url' => route('classPromotion.index')
        ];
    }
}
