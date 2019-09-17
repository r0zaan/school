<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::orderBy('name','ASC')->get();
        return view('backend.session.index',compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.session.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        $inputs = $request->all();
        Session::create($inputs);
        session()->flash('success', 'Session Created.');
        return [
            'status' => 'success',
            'return_url' => route('sessions.index')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        return view('backend.session.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        return view('backend.session.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return array
     */
    public function update(Request $request, Session $session)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        $session->update($inputs);
        session()->flash('success', 'Session Updated.');
        return [
            'status' => 'success',
            'return_url' => route('sessions.index')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return array|\Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        if (!request()->ajax()) {
            return false;
        }
        $session->delete();
        session()->flash('success', 'Session Deleted.');
        return [
            'status' => 'success',
            'return_url' => url('admin/sessions')
        ];
    }
}
