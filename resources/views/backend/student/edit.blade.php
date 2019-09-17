@extends('backend.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admission Entry
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/products')}}">Students</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <ul class="nav nav-tabs">
            <li><a href="{{url('admin/students')}}">All</a></li>
            <li class="active"><a data-toggle="tab" href="#home">Create</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Admission Entry / Create Student</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body reload">
                                {!! Form::model($student,[
                                          'action' => ['Backend\StudentController@update', $student->id],
                                          'method' => 'PATCH',
                                          'class' => 'form-horizontal ajax-form-post',
                                          'files' => true
                                      ]) !!}

                                @include('backend.student.form')

                                <div class="box-footer text-right">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </div>


                                {!! Form::close() !!}
                                <div class="hidden add-data">

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
    <script>
        $(document).on('click', '.delete-color', function () {
            $(this).parents('.form-group').remove();
        })
        $(document).on('click', '.add-button', function () {
            var div = $('.add-div').html();
            var count = $('.add-div tr').length + 1;
            console.log(count);
            var addingDiv = `<tr><td>` + count + `</td>
                                         <td>{{ Form::text('name[]',null,['class'=>'form-control','placeholder'=>'']) }}</td>
                                            <td>{{ Form::number('age[]',null,['class'=>'form-control','placeholder'=>'']) }}</td>
                                            <td>{{ Form::text('education[]',null,['class'=>'form-control','placeholder'=>'']) }}</td>
                                            <td>{{ Form::text('school[]',null,['class'=>'form-control','placeholder'=>'']) }}</td>
                                            <td><button type="button" class="btn btn-danger delete-color"><i class="fa fa-trash"></i></button></td>
                                    </tr>`;
            console.log(div + addingDiv);
            $('.add-div').html(div + addingDiv);
        })
        $(document).on('click', '.delete-color', function () {
            $(this).parents('tr').remove();
        })
        $(document).on('change', '.classroom', function () {
            $('.section').empty();
            $('.section').append('<option value="">Loading...</option>');
            var classroomId = $(this).val();
            var url = APP_URL + '/admin/periods/sections/' + classroomId;
            console.log(url);
            $.get(url, function (data) {
                $('.section').empty();
                $('.section').append('<option value="">--Select Any One--</option>');
                $.each(data, function (i, item) {
                    $('.section').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                });
            })
        });
    </script>
@endsection

