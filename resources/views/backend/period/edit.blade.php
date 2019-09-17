{!! Form::model($period,[
    'action' => ['Backend\PeriodController@update', $period->id],
    'method' => 'PATCH',
    'class' => 'form-horizontal ajax-form-post',
    'files' => true
]) !!}

@include('backend.period.form')

<div class="box-footer text-right">
    <button type="submit" class="btn btn-warning">Update</button>
</div>




{!! Form::close() !!}

