<div class="box-body">
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Class:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::select('classroom_id',$classrooms,null,['class'=>'form-control','placeholder'=>'Select Class']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Section Name:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Section Name']) }}
            <span class="error-message"></span>
        </div>
    </div>
</div>