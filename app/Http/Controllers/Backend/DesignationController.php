<?php

namespace App\Http\Controllers\Backend;

use App\Department;
use App\Designation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::orderBy('name','ASC')->get();
        return view('backend.designation.index',compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.designation.create',compact('departments'));
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
            'name' => 'required|max:50',
            'department_id' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        $inputs = $request->all();
        Designation::create($inputs);
        session()->flash('success', 'Designation Created.');
        return [
            'status' => 'success',
            'return_url' => route('designations.index')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        return view('backend.designation.show', compact('designation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        $departments = Department::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.designation.edit', compact('designation','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'department_id' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        $designation->update($inputs);
        session()->flash('success', 'Designation Updated.');
        return [
            'status' => 'success',
            'return_url' => route('designations.index')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return array|\Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        if (!request()->ajax()) {
            return false;
        }
        $designation->delete();
        session()->flash('success', 'Designation Deleted.');
        return [
            'status' => 'success',
            'return_url' => url('admin/designations')
        ];
    }
}
