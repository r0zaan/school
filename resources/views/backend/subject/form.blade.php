<div class="box-body">
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Session:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::select('session_id',$sessions,null,['class'=>'form-control','placeholder'=>'Select Session']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Class:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::select('classroom_id',$classrooms,null,['class'=>'form-control','placeholder'=>'Select Class']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Subject Name:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Subject Name']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Subject Code:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::text('code',null,['class'=>'form-control','placeholder'=>'Enter Subject Code']) }}
            <span class="error-message"></span>
        </div>
    </div>
</div>