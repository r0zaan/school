<?php

namespace App\Http\Controllers\Backend;

use App\Classroom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::orderBy('name','ASC')->get();
        return view('backend.class.index',compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.class.create');
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
            'name' => 'required|max:30'
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        Classroom::create($inputs);
        session()->flash('success', 'Class Created.');
        return [
            'status' => 'success',
            'return_url' => route('classrooms.index')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        return view('backend.class.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        return view('backend.class.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        $classroom->update($inputs);
        session()->flash('success', 'Class Updated.');
        return [
            'status' => 'success',
            'return_url' => route('classrooms.index')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return array|\Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        if (!request()->ajax()) {
            return false;
        }
        $classroom->delete();
        session()->flash('success', 'Class Deleted.');
        return [
            'status' => 'success',
            'return_url' => url('admin/classrooms')
        ];
    }
}
