<?php

namespace App\Http\Controllers\Backend;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::orderBy('name','ASC')->get();
        return view('backend.group.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.group.create');
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
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        Group::create($inputs);
        session()->flash('success', 'Group Created.');
        return [
            'status' => 'success',
            'return_url' => route('groups.index')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return view('backend.group.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('backend.group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        $group->update($inputs);
        session()->flash('success', 'Group Updated.');
        return [
            'status' => 'success',
            'return_url' => route('groups.index')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return array
     */
    public function destroy(Group $group)
    {
        if (!request()->ajax()) {
            return false;
        }
        $group->delete();
        session()->flash('success', 'Group Deleted.');
        return [
            'status' => 'success',
            'return_url' => url('admin/groups')
        ];
    }
}
