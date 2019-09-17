{!! Form::model($group,[
    'action' => ['Backend\GroupController@update', $group->id],
    'method' => 'PATCH',
    'class' => 'form-horizontal ajax-form-post'
]) !!}

@include('backend.group.form')

<div class="box-footer text-right">
    <button type="submit" class="btn btn-warning">Update</button>
</div>




{!! Form::close() !!}

