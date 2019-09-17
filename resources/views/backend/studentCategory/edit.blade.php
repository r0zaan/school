{!! Form::model($studentCategory,[
    'action' => ['Backend\StudentCategoryController@update', $studentCategory->id],
    'method' => 'PATCH',
    'class' => 'form-horizontal ajax-form-post',
    'files' => true
]) !!}

@include('backend.studentCategory.form')

<div class="box-footer text-right">
    <button type="submit" class="btn btn-warning">Update</button>
</div>




{!! Form::close() !!}

