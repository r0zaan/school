@extends('backend.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Periods
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Periods</a></li>
            <li class="active">Index</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">All</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Data Tables</h3>
                            </div>
                                <button type="button" class="btn btn-primary ajax-modal"
                                        data-url="{{ action('Backend\PeriodController@create') }}"
                                        style="position: absolute;right: 10px;top: 10px;">
                                    + New Period
                                </button>
                        <!-- /.box-header -->
                            <div class="box-body reload">
                                <table id="brand" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Class</th>
                                        <th>Class</th>
                                        <th>Name</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($periods as $key => $period)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$period->classroom->name}}</td>
                                            <td>{{$period->section->name}}</td>
                                            <td>{{$period->name}}</td>
                                            <td>{{$period->from}}</td>
                                            <td>{{$period->to}}</td>
                                            <td>
                                            <a title="Show"
                                                   data-url="{{action('Backend\PeriodController@show', $period->id)}}"
                                                   class="btn btn-primary ajax-modal"><i class="fa fa-eye"></i></a>
                                               <a title="Edit"
                                                       data-url="{{action('Backend\PeriodController@edit', $period->id)}}"
                                                       class="btn btn-success ajax-modal"><i
                                                                class="fa fa-pencil-square-o"></i></a>
                                              <form action="{{ route('periods.destroy', array($period->id)) }}"
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

        $(document).on('change', '.classroom', function () {
            $('.section').empty();
            $('.section').append('<option value="">Loading...</option>');
            var classroomId = $(this).val();
            var url = APP_URL + '/admin/periods/sections/' + classroomId;

            console.log(url);
            $.get(url, function (data) {
                $('.section').empty();
                $('.section').append('<option value="">Select Section</option>');
                $.each(data, function (i, item) {
                    $('.section').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                });
            })
        });
    </script>
@endsection