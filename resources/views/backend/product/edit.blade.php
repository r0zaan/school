@extends('backend.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <link rel="stylesheet"
          href="{{asset('AdminLte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
    <section class="content-header">
        <h1>
            Products
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/products')}}">Products</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <ul class="nav nav-tabs">
            <li><a href="{{url('admin/products')}}">All</a></li>
            <li><a href="{{url('admin/products/create')}}">Create</a></li>
            <li class="active"><a data-toggle="tab" href="#home">Edit</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Product</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body reload">

                                {!! Form::model($product,[
                                    'action' => ['Backend\ProductController@update', $product->id],
                                    'method' => 'PATCH',
                                    'class' => 'form-horizontal ajax-form-post',
                                    'files' => 'true'
                                ]) !!}

                                @include('backend.product.form')

                                <div class="box-footer text-right">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </div>


                                {!! Form::close() !!}
                                <div class="hidden add-data">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Color Name:<span
                                                    class=help-block" style="color:red;">*</span></label>
                                        <div class="col-sm-1">
                                            {{ Form::text('color_name[]',null,['class'=>'form-control','placeholder'=>'','required']) }}
                                            <span class="error-message"></span>
                                        </div>
                                        <label for="name" class="col-sm-2 control-label">Color Code:<span
                                                    class=help-block" style="color:red;">*</span></label>
                                        <div class="col-sm-1">
                                            <div class="my-colorpicker2">
                                                {{ Form::text('color_code[]',null,['class'=>'form-control ','placeholder'=>'#fffff','required']) }}
                                                <div class="input-group-addon ">
                                                    <i></i>
                                                </div>
                                            </div>
                                        </div>
                                        <label for="name" class="col-sm-1 control-label">Image:<span class=help-block"
                                                                                                     style="color:red;">*</span></label>
                                        <div class="col-sm-2">
                                            {{ Form::file('image[]',['class'=>'form-control ','required']) }}
                                            <span class="error-message"></span>
                                        </div>
                                        <label for="name" class="col-sm-1 control-label">Quantity:<span
                                                    class=help-block" style="color:red;">*</span></label>
                                        <div class="col-sm-1">
                                            {{ Form::text('quantity[]',null,['class'=>'form-control ','required']) }}
                                            <span class="error-message"></span>
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn btn-danger delete-color"><i
                                                        class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')

    <script src="{{asset('Adminlte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
    <script>
        $('.my-colorpicker2').colorpicker();
        $(document).on('click', '.add-button', function () {
            var addingDiv = $('.add-data').html();
            var div = $('.add-color').html();
            $('.add-color').html(div + addingDiv);
            $('.my-colorpicker2').colorpicker();
        })
        $(document).on('click', '.delete-color', function () {
          if($(this).attr('data-url')) {
              var url = $(this).attr('data-url');

              var button = $(this);

              swal({
                      title: "Are you sure?",
                      text: "Are you sure you want to delete this!",
                      type: "info",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55 ",
                      confirmButtonText: "Yes, Delete it!",
                      closeOnConfirm: false
                  },
                  function () {

                      var request_data = {};

                      request_data['_token'] = $(document).find('input[name=_token]').val();

                      $.ajax({
                          type: 'DELETE',
                          url: url,
                          data: request_data,
                          success: function (data) {
                              console.log(data);
                              if (data.status === 'success') {
                                  // location.reload();
                                  button.parents('.form-group').remove();
                              }
                              if (data.status === 'fail') {
                                  swal("Cannot Delete!",
                                      data.message, "error");
                              }
                          }
                      });

                      swal("Deleted!", "Deleted Successfully!", "success");
                  });

              return false;
          }else{
              $(this).parents('.form-group').remove();
          }
        })
    </script>
@endsection


