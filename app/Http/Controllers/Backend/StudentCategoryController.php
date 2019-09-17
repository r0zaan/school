<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\StudentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentCategories = StudentCategory::orderBy('name','ASC')->get();
        return view('backend.studentCategory.index',compact('studentCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.studentCategory.create');
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
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        $inputs = $request->all();
        StudentCategory::create($inputs);
        session()->flash('success', 'Student Category Created.');
        return [
            'status' => 'success',
            'return_url' => route('studentCategories.index')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentCategory  $studentCategory
     * @return \Illuminate\Http\Response
     */
    public function show(StudentCategory $studentCategory)
    {
        return view('backend.studentCategory.show', compact('studentCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentCategory  $studentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentCategory $studentCategory)
    {
        return view('backend.studentCategory.edit', compact('studentCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentCategory  $studentCategory
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, StudentCategory $studentCategory)
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
        $studentCategory->update($inputs);
        session()->flash('success', 'Student Category Updated.');
        return [
            'status' => 'success',
            'return_url' => route('studentCategories.index')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentCategory  $studentCategory
     * @return array|\Illuminate\Http\Response
     */
    public function destroy(StudentCategory $studentCategory)
    {
        if (!request()->ajax()) {
            return false;
        }
        $studentCategory->delete();
        session()->flash('success', 'Student Category Deleted.');
        return [
            'status' => 'success',
            'return_url' => url('admin/studentCategories')
        ];
    }
}
