<div class="box-body">
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Session Name:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Session Name']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Start Date:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::date('start_date',null,['class'=>'form-control']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">End Date:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::date('end_date',null,['class'=>'form-control']) }}
            <span class="error-message"></span>
        </div>
    </div>
</div>