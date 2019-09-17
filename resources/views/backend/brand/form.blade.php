<div class="box-body">
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Name:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Brand Name']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Self Brand:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::select('self_product',['Yes'=>'Yes','No'=>'No'],null,['class'=>'form-control','placeholder'=>'Select Any One']) }}
            <span class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Image:<span class=help-block" style="color:red;">*</span></label>
        <div class="col-sm-6">
            {{ Form::file('image',['class'=>'form-control']) }}
            <span class="error-message"></span>
        </div>
    </div>
</div>