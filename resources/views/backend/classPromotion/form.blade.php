<div class="box-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Class:<span class=help-block" style="color:red;">*</span></label>
                <div class="col-sm-6">
                    {{ Form::select('classroom_id',$classrooms,null,['class'=>'form-control classroom','placeholder'=>'--Select Any One--']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Section:<span class=help-block"
                                                                                  style="color:red;">*</span></label>
                <div class="col-sm-6">
                    {{ Form::select('section_id',[],null,['class'=>'form-control section','placeholder'=>'--Select Any One--']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Students:</label>
                <div class="col-sm-4">
                    {{ Form::select('student_id[]',[], null,['class'=>'select2 form-control students','data-placeholder'=>'--Select Any One--','id' => 'students','multiple']) }}
                    <span class="error-message"></span>
                </div>
                <input type="checkbox" id="select_all"> Select All
            </div>

        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Promotion Class:<span class=help-block" style="color:red;">*</span></label>
                <div class="col-sm-6">
                    {{ Form::select('promotion_classroom_id',$classrooms,null,['class'=>'form-control promotion_classroom','placeholder'=>'--Select Any One--']) }}
                    <span class="error-message"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Select Section:<span class=help-block"
                                                                                  style="color:red;">*</span></label>
                <div class="col-sm-6">
                    {{ Form::select('promotion_section_id',[],null,['class'=>'form-control promotion_section','placeholder'=>'--Select Any One--']) }}
                    <span class="error-message"></span>
                </div>
            </div>
        </div>
    </div>
</div>