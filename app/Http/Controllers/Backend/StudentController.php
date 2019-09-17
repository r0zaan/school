<?php

namespace App\Http\Controllers\Backend;

use App\Classroom;
use App\Http\Controllers\Controller;
use App\Session;
use App\Student;
use App\StudentCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('first_name','ASC')->get();
        return view('backend.student.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admission_id = 'NP'.$formattedNumber = sprintf('%07d', (User::latest()->first()) ? User::latest()->first()->id : '1' );
        $classrooms = Classroom::orderBy('name','ASC')->get()->pluck('name','id');
        $studentCategories = StudentCategory::orderBy('name','ASC')->get()->pluck('name','id');
        $sessions = Session::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.student.create',compact('classrooms','studentCategories','sessions','admission_id'));
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
            // Student Information validation
            'ec_number' => 'required|max:30',
            'first_name' => "required|max:30",
            'last_name' => 'required|max:30',
            'middle_name' => 'max:30',
            'classroom_id' => 'required',
            'section_id' => 'required',
            'session_id' => 'required',
            'dob' => 'required',
            'religion' => 'required|max:30',
            'gender' => 'required',
            'blood_group' => 'required|max:30',

            // Contact Information
            'residential_address' => 'required|max:50',
            'residential_city' => 'required|max:50',
            'residential_zip_code' => 'required|max:30',
            'residential_state' => 'required|max:50',

            // Particulars of Father / Mother / Guardian #1
            'relationship_particular_one' => 'required',
            'name_particular_one' => 'required|max:60',
            'qualification_particular_one' => 'required|max:50',
            'mobile_no_particular_one' => 'required|max:50',

            // Particulars of Father / Mother / Guardian #2
            'relationship_particular_two' => 'required',
            'name_particular_two' => 'required|max:60',
            'qualification_particular_two' => 'required|max:50',
            'mobile_no_particular_two' => 'required|max:50',

            // Emergency Contact Information
            'name_of_contact' => 'required',
            'emergency_mobile' => 'required|max:50',

            // Requirements
            'food_service' => 'required',
            'transport_service' => 'required',
            'learning_disability' => 'required',
            'other_requirement' => 'max:200',

        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }

        $inputs = $request->all();
        $user_id = 'NP'.$formattedNumber = sprintf('%07d', (User::latest()->first()) ? User::latest()->first()->id : '1' );
//        return $user_id;
        $user = User::create([
            'name' => $inputs['first_name'] .' '.$inputs['last_name'] ,
            'email' => $inputs['first_name'].'.'.$inputs['last_name'],'@education.com',
            'password' => bcrypt('password'),
            'number' => $user_id
        ]);

        if($request->hasFile('image')){
            $path_one = 'storage/students/'.str_random(6) . '_' . time().'.'.$request->file('image')->getClientOriginalExtension();
            file_put_contents($path_one,file_get_contents($request->file('image')));
            $inputs['image'] = $path_one;
        } else {
            $inputs['image'] = "";
        }
        // Create Student
        $student = $user->student()->create([
            'admission_number' =>  $user_id,
            'ec_number' => $inputs['ec_number'],
            'first_name' => $inputs['first_name'],
            'middle_name' => $inputs['middle_name'],
            'last_name' => $inputs['last_name'],
            'classroom_id' => $inputs['classroom_id'],
            'section_id' => $inputs['section_id'],
            'session_id' => $inputs['session_id'],
            'dob' => $inputs['dob'],
            'place_of_birth' => $inputs['place_of_birth'],
            'gender' => $inputs['gender'],
            'religion' => $inputs['religion'],
            'student_category_id' => $inputs['student_category_id'],
            'student_uid' => $inputs['student_uid'],
            'mother_tongue' => $inputs['mother_tongue'],
            'blood_group' => $inputs['blood_group'],
            'image' => $inputs['image'],
        ]);

        // Contact Information
        $student->studentContactInformation()->create([
            'residential_address' => $inputs['residential_address'],
            'city' => $inputs['residential_city'],
            'zip_code' => $inputs['residential_zip_code'],
            'land_mark' => $inputs['residential_land_mark'],
            'state' => $inputs['residential_state'],
            'telephone' => $inputs['residential_telephone'],
        ]);

        // Student Last Attend
        $student->studentLastAttend()->create([
            'name_of_school' => $inputs['name_of_school'],
            'board' => $inputs['last_board'],
            'percentage' => $inputs['last_percentage'],
            'address' => $inputs['last_address'],
            'city' => $inputs['last_city'],
            'zip_code' => $inputs['last_zip_code'],
            'state' => $inputs['last_state'],
            'telephone' => $inputs['last_telephone'],
            'reason' => $inputs['reason'],
        ]);

        // Emergency Contact Information
        $student->studentEmergencyContact()->create([
            'name_of_contact' => $inputs['name_of_contact'],
            'address' => $inputs['emergency_address'],
            'relationship' => $inputs['emergency_relationship'],
            'telephone' => $inputs['emergency_telephone'],
            'mobile' => $inputs['emergency_mobile'],
        ]);

        // Emergency Contact Information

        $student->studentRequirement()->create([
            'food_service' => $inputs['food_service'],
            'transport_service' => $inputs['transport_service'],
            'learning_disability' => $inputs['learning_disability'],
            'other_requirement' => $inputs['other_requirement'],
        ]);


//        Particulars of Father / Mother / Guardian

        $student->studentGuardians()->create([
            'particular' => 'particular-1',
            'relationship' => $inputs['relationship_particular_one'],
            'name' => $inputs['name_particular_one'],
            'dob' => $inputs['dob_particular_one'],
            'qualification' => $inputs['qualification_particular_one'],
            'occupation' => $inputs['occupation_particular_one'],
            'designation' => $inputs['designation_particular_one'],
            'name_of_company' => $inputs['name_of_company_particular_one'],
            'work_location' => $inputs['work_location_particular_one'],
            'pan_no' => $inputs['pan_no_particular_one'],
            'telephone_no' => $inputs['telephone_no_particular_one'],
            'mobile_no' => $inputs['mobile_no_particular_one'],
            'email' => $inputs['email_particular_one'],
        ]);

        $student->studentGuardians()->create([
            'particular' => 'particular-2',
            'relationship' => $inputs['relationship_particular_two'],
            'name' => $inputs['name_particular_two'],
            'dob' => $inputs['dob_particular_two'],
            'qualification' => $inputs['qualification_particular_two'],
            'occupation' => $inputs['occupation_particular_two'],
            'designation' => $inputs['designation_particular_two'],
            'name_of_company' => $inputs['name_of_company_particular_two'],
            'work_location' => $inputs['work_location_particular_two'],
            'pan_no' => $inputs['pan_no_particular_two'],
            'telephone_no' => $inputs['telephone_no_particular_two'],
            'mobile_no' => $inputs['mobile_no_particular_two'],
            'email' => $inputs['email_particular_two'],
        ]);


//        Student Siblings

        if(isset($inputs['name'])){
            foreach($inputs['name'] as $key => $data){
                if(!$data == null || !$data = " ") {
                    $student->studentSiblings()->create([
                        'name' => $inputs['name'][$key],
                        'age' => $inputs['age'][$key],
                        'education' => $inputs['education'][$key],
                        'school' => $inputs['school'][$key],
                    ]);
                }
            }
        }
        session()->flash('success', 'Student Created.');
        return [
            'status' => 'success',
            'return_url' => route('students.index')
        ];


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('backend.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $admission_id = $student->admission_number;

        //Residential
        $student['residential_address'] = $student->studentContactInformation->residential_address;
        $student['residential_city'] = $student->studentContactInformation->city;
        $student['residential_zip_code'] = $student->studentContactInformation->zip_code;
        $student['residential_land_mark'] = $student->studentContactInformation->land_mark;
        $student['residential_state'] = $student->studentContactInformation->state;
        $student['residential_telephone'] = $student->studentContactInformation->telephone;


        //Emergency

        $student['name_of_contact'] = $student->studentEmergencyContact->name_of_contact;
        $student['emergency_address'] = $student->studentEmergencyContact->address;
        $student['emergency_relationship'] = $student->studentEmergencyContact->relationship;
        $student['emergency_telephone'] = $student->studentEmergencyContact->telephone;
        $student['emergency_mobile'] = $student->studentEmergencyContact->mobile;


        //LastAttend

        $student['name_of_school'] = $student->studentLastAttend->name_of_school;
        $student['last_board'] = $student->studentLastAttend->board;
        $student['last_percentage'] = $student->studentLastAttend->percentage;
        $student['last_address'] = $student->studentLastAttend->address;
        $student['last_city'] = $student->studentLastAttend->city;
        $student['last_zip_code'] = $student->studentLastAttend->zip_code;
        $student['last_state'] = $student->studentLastAttend->state;
        $student['last_telephone'] = $student->studentLastAttend->telephone;
        $student['reason'] = $student->studentLastAttend->reason;

        // Guardian One and Two

        $particularOne = $student->studentGuardians()->where('particular','particular-1')->first();
        $student['relationship_particular_one'] = $particularOne->relationship;
        $student['name_particular_one'] = $particularOne->name;
        $student['dob_particular_one'] = $particularOne->dob;
        $student['qualification_particular_one'] = $particularOne->qualification;
        $student['occupation_particular_one'] = $particularOne->occupation;
        $student['designation_particular_one'] = $particularOne->designation;
        $student['name_of_company_particular_one'] = $particularOne->name_of_company;
        $student['work_location_particular_one'] = $particularOne->work_location;
        $student['pan_no_particular_one'] = $particularOne->pan_no;
        $student['telephone_no_particular_one'] = $particularOne->telephone_no;
        $student['mobile_no_particular_one'] = $particularOne->mobile_no;
        $student['email_particular_one'] = $particularOne->email;


        $particularTwo = $student->studentGuardians()->where('particular','particular-2')->first();
        $student['relationship_particular_two'] = $particularTwo->relationship;
        $student['name_particular_two'] = $particularTwo->name;
        $student['dob_particular_two'] = $particularTwo->dob;
        $student['qualification_particular_two'] = $particularTwo->qualification;
        $student['occupation_particular_two'] = $particularTwo->occupation;
        $student['designation_particular_two'] = $particularTwo->designation;
        $student['name_of_company_particular_two'] = $particularTwo->name_of_company;
        $student['work_location_particular_two'] = $particularTwo->work_location;
        $student['pan_no_particular_two'] = $particularTwo->pan_no;
        $student['telephone_no_particular_two'] = $particularTwo->telephone_no;
        $student['mobile_no_particular_two'] = $particularTwo->mobile_no;
        $student['email_particular_two'] = $particularTwo->email;



        $classrooms = Classroom::orderBy('name','ASC')->get()->pluck('name','id');
        $sections = $student->classroom->sections()->orderBy('name','ASC')->get()->pluck('name','id');
        $studentCategories = StudentCategory::orderBy('name','ASC')->get()->pluck('name','id');
        $sessions = Session::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.student.edit', compact('student','admission_id','classrooms','studentCategories','sessions','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            // Student Information validation
            'ec_number' => 'required|max:30',
            'first_name' => "required|max:30",
            'last_name' => 'required|max:30',
            'middle_name' => 'max:30',
            'classroom_id' => 'required',
            'section_id' => 'required',
            'session_id' => 'required',
            'dob' => 'required',
            'religion' => 'required|max:30',
            'gender' => 'required',
            'blood_group' => 'required|max:30',

            // Contact Information
            'residential_address' => 'required|max:50',
            'residential_city' => 'required|max:50',
            'residential_zip_code' => 'required|max:30',
            'residential_state' => 'required|max:50',

            // Particulars of Father / Mother / Guardian #1
            'relationship_particular_one' => 'required',
            'name_particular_one' => 'required|max:60',
            'qualification_particular_one' => 'required|max:50',
            'mobile_no_particular_one' => 'required|max:50',

            // Particulars of Father / Mother / Guardian #2
            'relationship_particular_two' => 'required',
            'name_particular_two' => 'required|max:60',
            'qualification_particular_two' => 'required|max:50',
            'mobile_no_particular_two' => 'required|max:50',

            // Emergency Contact Information
            'name_of_contact' => 'required',
            'emergency_mobile' => 'required|max:50',

            // Requirements
            'food_service' => 'required',
            'transport_service' => 'required',
            'learning_disability' => 'required',
            'other_requirement' => 'max:200',

        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }

        $inputs = $request->all();
        $user_id = 'NP'.$formattedNumber = sprintf('%07d', (User::latest()->first()) ? User::latest()->first()->id : '1' );
//        return $user_id;
        $user = $student->user()->update([
            'name' => $inputs['first_name'] .' '.$inputs['last_name'] ,
            'email' => $inputs['first_name'].'.'.$inputs['last_name'],'@education.com',
            'password' => bcrypt('password'),
            'number' => $user_id
        ]);

        if($request->hasFile('image')){
            $path_one = 'storage/students/'.str_random(6) . '_' . time().'.'.$request->file('image')->getClientOriginalExtension();
            file_put_contents($path_one,file_get_contents($request->file('image')));
            $inputs['image'] = $path_one;
        } else {
            $inputs['image'] = $student->image;
        }
        // Create Student
        $student->update([
            'admission_number' =>  $user_id,
            'ec_number' => $inputs['ec_number'],
            'first_name' => $inputs['first_name'],
            'middle_name' => $inputs['middle_name'],
            'last_name' => $inputs['last_name'],
            'classroom_id' => $inputs['classroom_id'],
            'section_id' => $inputs['section_id'],
            'session_id' => $inputs['session_id'],
            'dob' => $inputs['dob'],
            'place_of_birth' => $inputs['place_of_birth'],
            'gender' => $inputs['gender'],
            'religion' => $inputs['religion'],
            'student_category_id' => $inputs['student_category_id'],
            'student_uid' => $inputs['student_uid'],
            'mother_tongue' => $inputs['mother_tongue'],
            'blood_group' => $inputs['blood_group'],
            'image' => $inputs['image'],
        ]);

        // Contact Information
        $student->studentContactInformation()->update([
            'residential_address' => $inputs['residential_address'],
            'city' => $inputs['residential_city'],
            'zip_code' => $inputs['residential_zip_code'],
            'land_mark' => $inputs['residential_land_mark'],
            'state' => $inputs['residential_state'],
            'telephone' => $inputs['residential_telephone'],
        ]);

        // Student Last Attend
        $student->studentLastAttend()->update([
            'name_of_school' => $inputs['name_of_school'],
            'board' => $inputs['last_board'],
            'percentage' => $inputs['last_percentage'],
            'address' => $inputs['last_address'],
            'city' => $inputs['last_city'],
            'zip_code' => $inputs['last_zip_code'],
            'state' => $inputs['last_state'],
            'telephone' => $inputs['last_telephone'],
            'reason' => $inputs['reason'],
        ]);

        // Emergency Contact Information
        $student->studentEmergencyContact()->update([
            'name_of_contact' => $inputs['name_of_contact'],
            'address' => $inputs['emergency_address'],
            'relationship' => $inputs['emergency_relationship'],
            'telephone' => $inputs['emergency_telephone'],
            'mobile' => $inputs['emergency_mobile'],
        ]);

        // Emergency Contact Information

        $student->studentRequirement()->update([
            'food_service' => $inputs['food_service'],
            'transport_service' => $inputs['transport_service'],
            'learning_disability' => $inputs['learning_disability'],
            'other_requirement' => $inputs['other_requirement'],
        ]);


//        Particulars of Father / Mother / Guardian

        $student->studentGuardians()->where('particular','particular-1')->first()->update([
            'particular' => 'particular-1',
            'relationship' => $inputs['relationship_particular_one'],
            'name' => $inputs['name_particular_one'],
            'dob' => $inputs['dob_particular_one'],
            'qualification' => $inputs['qualification_particular_one'],
            'occupation' => $inputs['occupation_particular_one'],
            'designation' => $inputs['designation_particular_one'],
            'name_of_company' => $inputs['name_of_company_particular_one'],
            'work_location' => $inputs['work_location_particular_one'],
            'pan_no' => $inputs['pan_no_particular_one'],
            'telephone_no' => $inputs['telephone_no_particular_one'],
            'mobile_no' => $inputs['mobile_no_particular_one'],
            'email' => $inputs['email_particular_one'],
        ]);

        $student->studentGuardians()->where('particular','particular-2')->first()->update([
            'particular' => 'particular-2',
            'relationship' => $inputs['relationship_particular_two'],
            'name' => $inputs['name_particular_two'],
            'dob' => $inputs['dob_particular_two'],
            'qualification' => $inputs['qualification_particular_two'],
            'occupation' => $inputs['occupation_particular_two'],
            'designation' => $inputs['designation_particular_two'],
            'name_of_company' => $inputs['name_of_company_particular_two'],
            'work_location' => $inputs['work_location_particular_two'],
            'pan_no' => $inputs['pan_no_particular_two'],
            'telephone_no' => $inputs['telephone_no_particular_two'],
            'mobile_no' => $inputs['mobile_no_particular_two'],
            'email' => $inputs['email_particular_two'],
        ]);


//        Student Siblings

        if(isset($inputs['name'])){
            foreach($inputs['name'] as $key => $data){
                if(!$data == null || !$data = " ") {
                    $student->studentSiblings()->update([
                        'name' => $inputs['name'][$key],
                        'age' => $inputs['age'][$key],
                        'education' => $inputs['education'][$key],
                        'school' => $inputs['school'][$key],
                    ]);
                }
            }
        }
        session()->flash('success', 'Student Updated.');
        return [
            'status' => 'success',
            'return_url' => route('students.index')
        ];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return array|\Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        if (!request()->ajax()) {
            return false;
        }
        $student->user()->delete();
        $student->delete();
        session()->flash('success', 'Student Deleted.');
        return [
            'status' => 'success',
            'return_url' => url('admin/students')
        ];
    }
    public function changeStatus(Student $student)
    {
        if (!request()->ajax()) {
            return false;
        }
        if($student->status == "Active"){
            $student->update([
                'status' => "Not-Active"
            ]);
            session()->flash('success', 'Change Student to Not-Active.');
        }else{
            $student->update([
                'status' => "Active"
            ]);
            session()->flash('success', 'Change Student Active.');
        }
        return [
            'status' => 'success',
            'return_url' => url('admin/students')
        ];
    }
}
