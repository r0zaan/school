{!! Form::model($designation,[
    'action' => ['Backend\DesignationController@update', $designation->id],
    'method' => 'PATCH',
    'class' => 'form-horizontal ajax-form-post',
    'files' => true
]) !!}

@include('backend.designation.form')

<div class="box-footer text-right">
    <button type="submit" class="btn btn-warning">Update</button>
</div>




{!! Form::close() !!}

