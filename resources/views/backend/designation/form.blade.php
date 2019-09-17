<div class="box-body">
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Department:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::select('department_id',$departments,null,['class'=>'form-control','placeholder'=>'--Select Any One--']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Designation Name:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Designation Name']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Teacher:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::select('teacher',[0 =>'No', 1 => 'Yes'],null,['class'=>'form-control','placeholder'=>'--Select Any One--']) }}
            <span class="error-message"></span>
        </div>
    </div>
</div>