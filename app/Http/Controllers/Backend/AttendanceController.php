<?php

namespace App\Http\Controllers\Backend;

use App\Attendance;
use App\Classroom;
use App\Http\Controllers\Controller;
use App\Section;
use App\Session;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!empty($_GET)) {
            $this->validate($request, [
                'session_id' => 'required',
                'month' => 'required',
                'classroom_id' => 'required',
                'section_id' => 'required',
            ]);
            $month = date('m', strtotime($request->month));
            $year = date('Y', strtotime(Session::findOrFail($request->session_id)->start_date));
            $classroom = Classroom::findOrFail($request->classroom_id);
            $sections = $classroom->sections()->orderBy('name', 'ASC')->get()->pluck('name', 'id');
            $section = Section::find($request->section_id);
            $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $students = Student::orderBy('ec_number', 'ASC')
                ->where('classroom_id', $request->classroom_id)
                ->where('section_id', $request->section_id)
                ->get();
        }
        $sessions = Session::orderBy('name', 'ASC')->get()->pluck('name', 'id');
        $months = [
            'January' => 'January',
            'February' => 'February',
            'March' => 'March',
            'April' => 'April',
            'May' => 'May',
            'June' => 'June',
            'July' => 'July',
            'August' => 'August',
            'September' => 'September',
            'October' => 'October',
            'November' => 'November',
            'December' => 'December',
        ];
        $classrooms = Classroom::orderBy('name', 'ASC')->pluck('name', 'id');
        if (!empty($_GET)) {
            return view('backend.attendance.index', compact('sessions', 'months', 'classrooms', 'students', 'days', 'year', 'month', 'classroom', 'section', 'sections'));
        } else {
            return view('backend.attendance.index', compact('sessions', 'months', 'classrooms'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        if (isset($inputs['student'])) {
            foreach ($inputs['student'] as $key => $data) {
                $student = Student::find($key);
                foreach ($data as $date => $on) {
                    if ($student->attendances()->where('date', $date)->count() == 0) {
                        $student->attendances()->create([
                            'user_id' => Auth::id(),
                            'date' => $date
                        ]);
                    }
                }
                $student->attendances()->whereNotIn('date', array_keys($data))->delete();
            }
        } else {
            foreach ($inputs['allStudents'] as $data) {
                $student = Student::find($data);
                $student->attendances()->delete();
            }
        }
        session()->flash('success', 'Attendance Updated.');
        return redirect(url()->previous());
    }


    public function reportIndex(Request $request)
    {
        if (!empty($_GET)) {
            $this->validate($request, [
                'session_id' => 'required',
                'month' => 'required',
                'classroom_id' => 'required',
                'section_id' => 'required',
            ]);
            $month = date('m', strtotime($request->month));
            $year = date('Y', strtotime(Session::findOrFail($request->session_id)->start_date));
            $classroom = Classroom::findOrFail($request->classroom_id);
            $sections = $classroom->sections()->orderBy('name', 'ASC')->get()->pluck('name', 'id');
            $section = Section::find($request->section_id);
            $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $students = Student::orderBy('ec_number', 'ASC')
                ->where('classroom_id', $request->classroom_id)
                ->where('section_id', $request->section_id)
                ->get();
        }
        $sessions = Session::orderBy('name', 'ASC')->get()->pluck('name', 'id');
        $months = [
            'January' => 'January',
            'February' => 'February',
            'March' => 'March',
            'April' => 'April',
            'May' => 'May',
            'June' => 'June',
            'July' => 'July',
            'August' => 'August',
            'September' => 'September',
            'October' => 'October',
            'November' => 'November',
            'December' => 'December',
        ];
        $classrooms = Classroom::orderBy('name', 'ASC')->pluck('name', 'id');
        if (!empty($_GET)) {
            return view('backend.attendanceReport.index', compact('sessions', 'months', 'classrooms', 'students', 'days', 'year', 'month', 'classroom', 'section', 'sections'));
        } else {
            return view('backend.attendanceReport.index', compact('sessions', 'months', 'classrooms'));
        }
    }

}
