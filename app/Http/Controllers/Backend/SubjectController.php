<?php

namespace App\Http\Controllers\Backend;

use App\Classroom;
use App\Http\Controllers\Controller;
use App\Session;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::orderBy('name','ASC')->get();
        return view('backend.subject.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = Classroom::orderBy('name','ASC')->get()->pluck('name','id');
        $sessions = Session::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.subject.create',compact('classrooms','sessions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'code' => 'required|max:30|unique:subjects',
            'classroom_id' => 'required',
            'session_id' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        $inputs = $request->all();
        Subject::create($inputs);
        session()->flash('success', 'Subject Created.');
        return [
            'status' => 'success',
            'return_url' => route('subjects.index')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('backend.subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $classrooms = Classroom::orderBy('name','ASC')->get()->pluck('name','id');
        $sessions = Session::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.subject.edit', compact('classrooms','subject','sessions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'first_name' => "required|max:30|unique:subjects,code,$subject->id,id",
            'classroom_id' => 'required',
            'session_id' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        $subject->update($inputs);
        session()->flash('success', 'Subject Updated.');
        return [
            'status' => 'success',
            'return_url' => route('subjects.index')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return array
     */
    public function destroy(Subject $subject)
    {
        if (!request()->ajax()) {
            return false;
        }
        $subject->delete();
        session()->flash('success', 'Subject Deleted.');
        return [
            'status' => 'success',
            'return_url' => url('admin/subject')
        ];
    }
}
