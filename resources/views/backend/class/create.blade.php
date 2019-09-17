{!! Form::open([
    'action' => 'Backend\ClassroomController@store',
    'method' => 'POST',
    'class' => 'form-horizontal ajax-form-post',
    'files' => true
]) !!}

@include('backend.class.form')

<div class="box-footer text-right">
    <button type="submit" class="btn btn-warning">Create</button>
</div>




{!! Form::close() !!}

