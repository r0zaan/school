<?php

namespace App\Http\Controllers\Backend;

use App\Classroom;
use App\Http\Controllers\Controller;
use App\Period;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periods = Period::orderBy('classroom_id', 'ASC')->orderBy('section_id', 'ASC')->get();
        return view('backend.period.index', compact('periods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = Classroom::orderBy('name', 'ASC')->get()->pluck('name', 'id');
        return view('backend.period.create', compact('classrooms', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'from' => 'required',
            'to' => 'required',
            'classroom_id' => 'required',
            'section_id' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }
        $inputs = $request->all();
        Period::create($inputs);
        session()->flash('success', 'Period Created.');
        return [
            'status' => 'success',
            'return_url' => route('periods.index')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Period $period
     * @return \Illuminate\Http\Response
     */
    public function show(Period $period)
    {
        return view('backend.period.show', compact('period'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Period $period
     * @return \Illuminate\Http\Response
     */
    public function edit(Period $period)
    {
        $classrooms = Classroom::orderBy('name', 'ASC')->get()->pluck('name', 'id');
        $sections = $period->classroom()->orderBy('name','ASC')->get()->pluck('name', 'id');
        return view('backend.period.edit', compact('classrooms', 'sections', 'period'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Period $period
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, Period $period)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'from' => 'required',
            'to' => 'required',
            'classroom_id' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        if(!isset($inputs['lunch'])){
            $inputs['lunch'] = 0;
        }
        $period->update($inputs);
        session()->flash('success', 'Period Updated.');
        return [
            'status' => 'success',
            'return_url' => route('periods.index')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Period $period
     * @return array|\Illuminate\Http\Response
     */
    public function destroy(Period $period)
    {
        if (!request()->ajax()) {
            return false;
        }
        $period->delete();
        session()->flash('success', 'Period Deleted.');
        return [
            'status' => 'success',
            'return_url' => url('admin/periods')
        ];
    }
    public function getSections(Classroom $classroom)
    {
       return  $classroom->sections()->orderBy('name','ASC')->get();

    }
}
