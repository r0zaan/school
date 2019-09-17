{!! Form::model($brand,[
    'action' => ['Backend\BrandController@update', $brand->id],
    'method' => 'PATCH',
    'class' => 'form-horizontal ajax-form-post',
    'files' => true
]) !!}

@include('backend.brand.form')

<div class="box-footer text-right">
    <button type="submit" class="btn btn-warning">Update</button>
</div>




{!! Form::close() !!}

