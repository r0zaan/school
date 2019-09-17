@extends('backend.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h1>
            Products
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Products</a></li>
            <li class="active">Index</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">All</a></li>
            <li><a href="{{url('admin/products/create')}}">Create</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Data Tables</h3>
                            </div>
                            <a class="btn btn-primary"
                               href="{{ action('Backend\ProductController@create') }}"
                               style="position: absolute;right: 10px;top: 10px;">
                                + New Product
                            </a>
                            <!-- /.box-header -->
                            <div class="box-body reload">
                                <table id="brand" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Images</th>
                                        <th>Name</th>
                                        <th>Colors & Quantity</th>
                                        <th>Model Number</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Discount(%)</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key => $product)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <img src="{{url($product->colorImages()->first()->image)}}"
                                                     height="100px"/>
                                            </td>
                                            <td>{{$product->name}}</td>
                                            <td>
                                                @foreach($product->colorImages()->get() as $image)
                                                    <div>
                                                        <div style="background-color: {{$image->color_code}};height:15px;width: 15px; display: inline-block;"></div>
                                                        - {{$image->quantity}}
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td>{{$product->model_number}}</td>
                                            <td>{{$product->brand->name}}</td>
                                            <td>{{$product->group->name}}</td>
                                            <td>Rs. {{$product->price}}</td>
                                            <td>{{$product->discount_percentage}} %</td>
                                            <td>{{$product->colorImages->sum('quantity')}} piecs</td>
                                            <td>
                                                <a title="Show"
                                                   href="{{action('Backend\ProductController@show', $product->id)}}"
                                                   class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                <a title="Edit"
                                                   href="{{action('Backend\ProductController@edit', $product->id)}}"
                                                   class="btn btn-success"><i
                                                            class="fa fa-pencil-square-o"></i></a>
                                                <form action="{{ route('products.destroy', array($product->id)) }}"
                                                      method="DELETE" class="delete-data-ajax">
                                                    {!! csrf_field() !!}
                                                    <button type="submit" class="btn btn-danger" title="Delete">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>

        </div>
        <!-- /.row -->
    </section>
@endsection


@section('scripts')
    <script>
        $('#brand').DataTable({
            responsive: true,

        });

    </script>
@endsection