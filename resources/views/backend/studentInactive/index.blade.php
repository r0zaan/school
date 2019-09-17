@extends('backend.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h1>
            Inactive Students
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Inactive Students</a></li>
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
                            <!-- /.box-header -->
                            <div class="box-body reload">
                                <table id="brand" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Images</th>
                                        <th>Admission No</th>
                                        <th>Name</th>
                                        <th>Ec no</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $key => $student)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                @if($student->image == null || $student->image == " ")
                                                    No Photo
                                                @else
                                                    <img src="{{url($student->image)}}"
                                                         height="100px"/>
                                                @endif
                                            </td>
                                            <td>{{$student->admission_number}}</td>
                                            <td>{{$student->fullName()}}</td>
                                            <td>{{$student->ec_number}}</td>
                                            <td>
                                                @if($student->status == "Active")
                                                <div class="label label-primary">{{$student->status}}</div>
                                                    @elseif($student->status == "Not-Active")
                                                    <div class="label label-danger">{{$student->status}}</div>
                                                @endif
                                            <button class="btn btn-sm btn-warning change-status-ajax" data-url="{{url('admin/students/changeStatus/'.$student->id)}}">Change</button>

                                            </td>
                                            <td>
                                                <a title="Show"
                                                   href="{{action('Backend\StudentController@show', $student->id)}}"
                                                   class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                <a title="Edit"
                                                   href="{{action('Backend\StudentController@edit', $student->id)}}"
                                                   class="btn btn-success"><i
                                                            class="fa fa-pencil-square-o"></i></a>
                                                <form action="{{ route('students.destroy', array($student->id)) }}"
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

        $(document).on('click', '.change-status-ajax', function (e) {
            var url = $(this).attr('data-url');
console.log(url);
            swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to Change Status!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55 ",
                    confirmButtonText: "Yes, Change it!",
                    closeOnConfirm: false
                },
                function () {

                    var request_data = {};

                    $.ajax({
                        type: 'GET',
                        url: url,
                        success: function (data) {
                            console.log(data);
                            if (data.status == 'success') {
                                location.reload();
                            }
                            if (data.status === 'fail') {
                                swal("Cannot Change!",
                                    data.message, "error");
                            }
                        }
                    });

                    swal("Changed!", "Changed Successfully!", "success");
                });

            return false;
        });
    </script>
@endsection