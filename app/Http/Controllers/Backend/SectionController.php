<?php

namespace App\Http\Controllers\Backend;

use App\Classroom;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::orderBy('classroom_id','ASC')->get();
        return view('backend.section.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = Classroom::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.section.create',compact('classrooms'));
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
            'classroom_id' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        $inputs = $request->all();
        Section::create($inputs);
        session()->flash('success', 'Section Created.');
        return [
            'status' => 'success',
            'return_url' => route('sections.index')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return view('backend.section.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $classrooms = Classroom::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.section.edit', compact('classrooms','section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return array
     */
    public function update(Request $request, Section $section)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'classroom_id' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        $section->update($inputs);
        session()->flash('success', 'Section Updated.');
        return [
            'status' => 'success',
            'return_url' => route('sections.index')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return array|\Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        if (!request()->ajax()) {
            return false;
        }
        $section->delete();
        session()->flash('success', 'Section Deleted.');
        return [
            'status' => 'success',
            'return_url' => url('admin/sections')
        ];
    }
}
