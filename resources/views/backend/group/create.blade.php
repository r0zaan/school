{!! Form::open([
    'action' => 'Backend\GroupController@store',
    'method' => 'POST',
    'class' => 'form-horizontal ajax-form-post'
]) !!}

@include('backend.group.form')

<div class="box-footer text-right">
    <button type="submit" class="btn btn-warning">Create</button>
</div>




{!! Form::close() !!}

