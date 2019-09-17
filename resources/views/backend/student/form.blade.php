<div class="box-body">
    <h4 style="color:#3c8dbc;margin-bottom: 20px" class="text-center"><b>Application Form For Registration</b></h4>
    <br/>
    <div class="form-group">
        <label for="name" class="col-sm-2">Admission No.:<span class=help-block"
                                                               style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::text('admission_number',$admission_id,['class'=>'form-control','placeholder'=>'','disabled']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Ec NO.:<span class=help-block"
                                                        style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::text('ec_number',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">First Name:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::text('first_name',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Middle Name:</label>
        <div class="col-sm-3">
            {{ Form::text('middle_name',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">Last Name:<span class=help-block"
                                                           style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::text('last_name',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Admission For Class:<span class=help-block"
                                                                     style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::select('classroom_id',$classrooms,null,['class'=>'form-control classroom','placeholder'=>'--Select Any One--']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">Select Section:<span class=help-block"
                                                                style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::select('section_id',(isset($sections)) ? $sections : [] ,null,['class'=>'form-control section','placeholder'=>'--Select Any One--']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Select Session:<span class=help-block"
                                                                style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::select('session_id',$sessions ,null,['class'=>'form-control','placeholder'=>'--Select Any One--']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">Date Of Birth:<span class=help-block"
                                                               style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::date('dob',null,['class'=>'form-control']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Place Of Birth:</label>
        <div class="col-sm-3">
            {{ Form::text('place_of_birth' ,null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">Religion:<span class=help-block"
                                                          style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::text('religion',null,['class'=>'form-control']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Student Type:</label>
        <div class="col-sm-3">
            {{ Form::select('student_category_id',$studentCategories ,null,['class'=>'form-control','placeholder'=>'--Select Any One--']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">Gender:<span class=help-block"
                                                        style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::select('gender',['Male' => 'Male','Female' => 'Female'],null,['class'=>'form-control','placeholder'=>'--Select Any One--']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Student UID:</label>
        <div class="col-sm-3">
            {{ Form::text('student_uid' ,null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">Mother Tongue:</label>
        <div class="col-sm-3">
            {{ Form::text('mother_tongue',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Blood Group:<span class=help-block"
                                                             style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::text('blood_group' ,null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">Photo:</label>
        <div class="col-sm-3">
            {{ Form::file('image',['class'=>'form-control']) }}
            <span class="error-message"></span>
        </div>
    </div>

    <br/>
    <hr/>
    <h4 style="color:#3c8dbc;margin-bottom: 20px" class="text-center"><b>Contact Information : Residential</b></h4>
    <br/>
    <div class="form-group">
        <label for="name" class="col-sm-2">Residential Address:<span class=help-block"
                                                                     style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::text('residential_address',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">City:<span class=help-block"
                                                      style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::text('residential_city',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">Postal/Zipcode:<span class=help-block"
                                                                style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::text('residential_zip_code',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Landmark:</label>
        <div class="col-sm-3">
            {{ Form::text('residential_land_mark',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">State:<span class=help-block"
                                                       style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::text('residential_state',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Telephone:</label>
        <div class="col-sm-3">
            {{ Form::text('residential_telephone',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <br/>
    <hr/>
    <h4 style="color:#3c8dbc;margin-bottom: 20px" class="text-center"><b>Details of Last School Attended</b></h4>
    <br/>
    <div class="form-group">
        <label for="name" class="col-sm-2">Name of the School:</label>
        <div class="col-sm-3">
            {{ Form::text('name_of_school',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Curriculum/Board:</label>
        <div class="col-sm-3">
            {{ Form::text('last_board',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">Percentage:</label>
        <div class="col-sm-3">
            {{ Form::text('last_percentage',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Address:</label>
        <div class="col-sm-3">
            {{ Form::text('last_address',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">City:</label>
        <div class="col-sm-3">
            {{ Form::text('last_city',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Postal/zipcoode:</label>
        <div class="col-sm-3">
            {{ Form::text('last_zip_code',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">State:</label>
        <div class="col-sm-3">
            {{ Form::text('last_state',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Telephone:</label>
        <div class="col-sm-3">
            {{ Form::text('last_telephone',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-2">Reason for Change:</label>
        <div class="col-sm-3">
            {{ Form::text('reason',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <br/>
    <hr/>
    <div class="row">
        <div class="col-lg-6">
            <h4 style="color:#3c8dbc;margin-bottom: 20px" class="text-center"><b>Particulars of Father / Mother /
                    Guardian #1</b></h4>
            <br/>
            <div class="form-group">
                <label for="name" class="col-sm-6">Relationship with the child:<span class=help-block"
                                                                                     style="color:red;">*</span></label>
                <div class="col-sm-6">
                    {{ Form::select('relationship_particular_one',['Father' => 'Father','Mother' => 'Mother', 'Guardian' => 'Guardian' ], null,['class'=>'form-control','placeholder'=>'--Select Any One--']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Name:<span class=help-block"
                                                              style="color:red;">*</span></label>
                <div class="col-sm-6">
                    {{ Form::text('name_particular_one',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Date Of Birth:</label>
                <div class="col-sm-6">
                    {{ Form::date('dob_particular_one',null,['class'=>'form-control']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Qualification:<span class=help-block"
                                                                       style="color:red;">*</span></label>
                <div class="col-sm-6">
                    {{ Form::text('qualification_particular_one',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Occupation:</label>
                <div class="col-sm-6">
                    {{ Form::text('occupation_particular_one',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Designation:</label>
                <div class="col-sm-6">
                    {{ Form::text('designation_particular_one',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Name Of Company:</label>
                <div class="col-sm-6">
                    {{ Form::text('name_of_company_particular_one',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Work Location:</label>
                <div class="col-sm-6">
                    {{ Form::text('work_location_particular_one',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Pan No.:</label>
                <div class="col-sm-6">
                    {{ Form::text('pan_no_particular_one',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Telephone No.:</label>
                <div class="col-sm-6">
                    {{ Form::text('telephone_no_particular_one',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Mobile:<span class=help-block"
                                                                style="color:red;">*</span></label>
                <div class="col-sm-6">
                    {{ Form::text('mobile_no_particular_one',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Email:</label>
                <div class="col-sm-6">
                    {{ Form::text('email_particular_one',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <h4 style="color:#3c8dbc;margin-bottom: 20px" class="text-center"><b>Particulars of Father / Mother /
                    Guardian #2</b></h4>
            <br/>
            <div class="form-group">
                <label for="name" class="col-sm-6">Relationship with the child:<span class=help-block"
                                                                                     style="color:red;">*</span></label>
                <div class="col-sm-6">
                    {{ Form::select('relationship_particular_two',['Father' => 'Father','Mother' => 'Mother', 'Guardian' => 'Guardian' ],null,['class'=>'form-control','placeholder'=>'--Select Any One--']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Name:<span class=help-block"
                                                              style="color:red;">*</span></label>
                <div class="col-sm-6">
                    {{ Form::text('name_particular_two',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Date Of Birth:</label>
                <div class="col-sm-6">
                    {{ Form::date('dob_particular_two',null,['class'=>'form-control']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Qualification:<span class=help-block"
                                                                       style="color:red;">*</span></label>
                <div class="col-sm-6">
                    {{ Form::text('qualification_particular_two',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Occupation:</label>
                <div class="col-sm-6">
                    {{ Form::text('occupation_particular_two',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Designation:</label>
                <div class="col-sm-6">
                    {{ Form::text('designation_particular_two',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Name Of Company:</label>
                <div class="col-sm-6">
                    {{ Form::text('name_of_company_particular_two',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Work Location:</label>
                <div class="col-sm-6">
                    {{ Form::text('work_location_particular_two',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Pan No.:</label>
                <div class="col-sm-6">
                    {{ Form::text('pan_no_particular_two',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Telephone No.:</label>
                <div class="col-sm-6">
                    {{ Form::text('telephone_no_particular_two',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Mobile:<span class=help-block"
                                                                style="color:red;">*</span></label>
                <div class="col-sm-6">
                    {{ Form::text('mobile_no_particular_two',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-6">Email:</label>
                <div class="col-sm-6">
                    {{ Form::text('email_particular_two',null,['class'=>'form-control','placeholder'=>'']) }}
                    <span class="error-message"></span>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <hr/>
    <h4 style="color:#3c8dbc;margin-bottom: 20px" class="text-center"><b>Emergency Contact Information</b></h4>
    <br/>
    <div class="form-group">
        <label for="name" class="col-sm-2">Name of Contact Person:<span class=help-block"
                                                                        style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::text('name_of_contact',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Address of Contact Person:</label>
        <div class="col-sm-3">
            {{ Form::text('emergency_address',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">Relationship with the Child:</label>
        <div class="col-sm-3">
            {{ Form::text('emergency_relationship',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
        <label for="name" class="col-sm-2">Telephone:</label>
        <div class="col-sm-3">
            {{ Form::text('emergency_telephone',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">Mobile:<span class=help-block"
                                                        style="color:red;">*</span></label>
        <div class="col-sm-3">
            {{ Form::text('emergency_mobile',null,['class'=>'form-control','placeholder'=>'']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <br/>
    <hr/>
    <h4 style="color:#3c8dbc;margin-bottom: 20px" class="text-center"><b>Requirements</b></h4>
    <br/>
    <div class="form-group">
        <label for="name" class="col-sm-8">Do You require food service facility for your child?</label>
        <div class="col-sm-1">
            {{ Form::radio('food_service', 1) }}
            Yes
        </div>
        <div class="col-sm-1">
            {{ Form::radio('food_service', 0, true) }}
            No
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-8">Do You require transport service facility for your child?</label>
        <div class="col-sm-1">
            {{ Form::radio('transport_service', 1) }}
            Yes
        </div>
        <div class="col-sm-1">
            {{ Form::radio('transport_service', 0, true) }}
            No
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-8">Has your child identified with any learning disability?</label>
        <div class="col-sm-1">
            {{ Form::radio('learning_disability', 1) }}
            Yes
        </div>
        <div class="col-sm-1">
            {{ Form::radio('learning_disability', 0, true) }}
            No
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-8">Please specify any requirement if any?</label>
        <div class="col-sm-3">
            {{ Form::text('other_requirement',null,['class'=>'form-control','placeholder'=>'Other Requirement']) }}
        </div>
    </div>
    <br/>
    <hr/>
    <h4 style="color:#3c8dbc;margin-bottom: 20px" class="text-center"><b>Details of Child's Sibling</b></h4>
    <br/>
    <table class="table table-bordered">
        <thead>
        <tr style="color: white;
    background: #3c8dbc;">
            <th>S.No.</th>
            <th>Name</th>
            <th>Age</th>
            <th>Education</th>
            <th>Name Of the School</th>
        </tr>
        </thead>
        <tbody class="add-div">
            <tr>
                <td>1</td>
                <td>{{ Form::text('name[]',null,['class'=>'form-control','placeholder'=>'']) }}</td>
                <td>{{ Form::number('age[]',null,['class'=>'form-control','placeholder'=>'']) }}</td>
                <td>{{ Form::text('education[]',null,['class'=>'form-control','placeholder'=>'']) }}</td>
                <td>{{ Form::text('school[]',null,['class'=>'form-control','placeholder'=>'']) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="form-group">
        <label for="name" class="col-sm-10"></label>
        <div class="col-sm-2">
            <button type="button" class="btn btn-primary add-button"><i class="fa fa-plus"></i> Add</button>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="col-sm-1">
            {{ Form::checkbox('agreement', 1, true) }}
        </label>
        <div class="col-sm-8">
            I certify that the above particulars given by me are true and I agree to abide by the rules, regulations and policies of the school. I understand that guarantee admission to the school.
        </div>

    </div>
</div>