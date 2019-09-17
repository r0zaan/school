<?php

namespace App\Http\Controllers\Backend;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::orderBy('name','ASC')->get();
        return view('backend.department.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.department.create');
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
            'name' => 'required|max:50'
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        Department::create($inputs);
        session()->flash('success', 'Department Created.');
        return [
            'status' => 'success',
            'return_url' => route('departments.index')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('backend.department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('backend.department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        $department->update($inputs);
        session()->flash('success', 'Department Updated.');
        return [
            'status' => 'success',
            'return_url' => route('departments.index')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return array|\Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        if (!request()->ajax()) {
            return false;
        }
        $department->delete();
        session()->flash('success', 'Department Deleted.');
        return [
            'status' => 'success',
            'return_url' => url('admin/departments')
        ];
    }
}
