{!! Form::model($subject,[
    'action' => ['Backend\SubjectController@update', $subject->id],
    'method' => 'PATCH',
    'class' => 'form-horizontal ajax-form-post',
    'files' => true
]) !!}

@include('backend.subject.form')

<div class="box-footer text-right">
    <button type="submit" class="btn btn-warning">Update</button>
</div>




{!! Form::close() !!}

