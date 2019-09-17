<div class="box-body">
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Class:<span class=help-block"
                                                                     style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::select('classroom_id',$classrooms,null,['class'=>'form-control classroom','placeholder'=>'Select Class']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Section:<span class=help-block"
                                                                       style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::select('section_id',(isset($period))? $sections : [],null,['class'=>'form-control section','placeholder'=>'Select Section']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Period Name:<span class=help-block"
                                                                           style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Period Name']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">From:<span class=help-block"
                                                                    style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::time('from',null,['class'=>'form-control']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">To:<span class=help-block"
                                                                  style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::time('to',null,['class'=>'form-control']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">To:</label>
        <div class="col-sm-6">
            {{ Form::checkbox('lunch') }}
            <span class="error-message"></span>
        </div>
    </div>
</div>