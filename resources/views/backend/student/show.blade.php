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
            <li class="active"><a data-toggle="tab" href="#home">Show</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Create Product</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body reload">
                                <div class="form-horizontal">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Name:</label>
                                            <div class="col-sm-4 label-top">
                                                {{$product->name}}
                                            </div>
                                            <label for="name" class="col-sm-2 control-label">Model Number:</label>
                                            <div class="col-sm-4 label-top">
                                                {{$product->model_number}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Brand:</label>
                                            <div class="col-sm-4 label-top">
                                                {{$product->brand->name}}
                                            </div>
                                            <label for="name" class="col-sm-2 control-label">Category:</label>
                                            <div class="col-sm-4 label-top">
                                                {{$product->group->name}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Price:</label>
                                            <div class="col-sm-4 label-top">
                                               Rs. {{$product->price}}
                                            </div>
                                            <label for="name" class="col-sm-2 control-label">Discount:</label>
                                            <div class="col-sm-4 label-top">
                                                {{$product->discount_percentage}} %
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Description:</label>
                                            <div class="col-sm-10 label-top">
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                        @foreach($product->colorImages()->get() as $key => $image)
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Color Name:<span class=help-block"
                                                                                                                  style="color:red;">*</span></label>
                                                <div class="col-sm-1  label-top">
                                                    {{ $image['color_name'] }}

                                                </div>
                                                <label for="name" class="col-sm-2 control-label">Color Code:</label>
                                                <div class="col-sm-1">
                                                    <div style="background-color: {{$image['color_code']}};height:15px;width: 15px; margin-top: 10px; display: inline-block;"></div>
                                                </div>
                                                <label for="name" class="col-sm-1 control-label">Image:</label>
                                                <div class="col-sm-2">
                                                    <a href="{{url($image->image)}}" target="_blank"><img src="{{url($image['image'])}}"
                                                         height="100px"/></a>
                                                </div>
                                                <label for="name" class="col-sm-1 control-label">Quantity:</label>
                                                <div class="col-sm-1">
                                                    {{ $image['quantity'] }}
                                                </div>

                                            </div>
                                        @endforeach

                                        <a href="{{url('admin/products')}}" class="btn btn-default pull-right" data-dismiss="modal">Close</a>
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