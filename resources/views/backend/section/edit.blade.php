{!! Form::model($section,[
    'action' => ['Backend\SectionController@update', $section->id],
    'method' => 'PATCH',
    'class' => 'form-horizontal ajax-form-post',
    'files' => true
]) !!}

@include('backend.section.form')

<div class="box-footer text-right">
    <button type="submit" class="btn btn-warning">Update</button>
</div>




{!! Form::close() !!}

