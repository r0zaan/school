<div class="box-body">
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Class Name:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Class Name']) }}
            <span class="error-message"></span>
        </div>
    </div>
</div>