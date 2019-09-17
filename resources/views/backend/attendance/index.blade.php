@extends('backend.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Attendance
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Attendance</a></li>
            <li class="active">Entry</li>
        </ol>
    </section>


    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Search</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            @if(empty($_GET))
                {!! Form::open([
                               'action' => 'Backend\AttendanceController@index',
                               'method' => 'GET',
                               'role' => 'form',
                           ]) !!}
            @else
                {!! Form::model([
                'session_id' => $_GET['session_id'],
                'month' => $_GET['month'],
                'classroom_id' => $_GET['classroom_id'],
                'section_id' => $_GET['section_id'],
                ],[
                               'action' => 'Backend\AttendanceController@index',
                               'method' => 'GET',
                               'role' => 'form',
                           ]) !!}
            @endif
            <div class="box-body">

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Session:<span class=help-block" style="color:red;">*</span></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{ Form::select('session_id',$sessions,null,['class'=>'form-control pull-right ','placeholder'=>'--Select Any One--']) }}
                                <span class="error-message"></span>
                            </div>
                            <!-- /.input group -->

                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Month:<span class=help-block" style="color:red;">*</span></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{ Form::select('month',$months,null,['class'=>'form-control pull-right ','placeholder'=>'--Select Any One--']) }}
                                <span class="error-message"></span>
                            </div>
                            <!-- /.input group -->

                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Class:<span class=help-block" style="color:red;">*</span></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{ Form::select('classroom_id',$classrooms,null,['class'=>'form-control pull-right classroom','placeholder'=>'--Select Any One--']) }}
                                <span class="error-message"></span>
                            </div>
                            <!-- /.input group -->

                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Section:<span class=help-block" style="color:red;">*</span></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{ Form::select('section_id',(isset($sections)) ? $sections : [],null,['class'=>'form-control pull-right section','placeholder'=>'--Select Any One--']) }}
                                <span class="error-message"></span>
                            </div>
                            <!-- /.input group -->

                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Search</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- Main content -->
        <div class="loader-report">
            <img class="loader loaderImg" src="{{ asset( 'AdminLTE/dist/img/loader.gif' ) }}" alt="Loading">
        </div>
    </section>


    <!-- Main content -->
    <div id="load-report-results">
        @if(!empty($_GET))
            <section class="content-header">
                <h1>
                    {{$classroom->name}} - {{$section->name}} ({{$year}} - {{$_GET['month']}})
                    <small>Student Attendance</small>
                    {{--{{$date}} <small>{{$nepDate}}</small>--}}
                </h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            {!! Form::open([
                               'action' => 'Backend\AttendanceController@store',
                               'method' => 'POST',
                               'role' => 'form',
                           ]) !!}
                            <div class="box-header">
                                <h3 class="box-title">Daily Attendance of Student</h3>
                                <button class="btn btn-primary">Submit</button>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>EC. number</th>
                                        <th>Name</th>
                                        @for($day = 1; $day <= $days ;$day++)
                                            @if((date('N', strtotime($year.'-'.$month.'-'.$day)) == 6))
                                                <th>{{$day}}(S)</th>
                                            @else
                                                <th>{{$day}}</th>
                                            @endif
                                        @endfor
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <th>{{$student->ec_number}}</th>
                                            <td>{{$student->fullName()}}</td>
                                            @for($day = 1; $day <= $days ;$day++)

                                                @if((date('N', strtotime($year.'-'.$month.'-'.$day)) == 6))
                                                    <td class="label-success"></td>
                                                @else
                                                    <td>
                                                        <?php $date = date('Y-m-d', strtotime($year.'-'.$month.'-'.$day)); ?>
                                                        <input type="checkbox" name="student[{{$student->id}}][{{$date}}]"

                                                        @if($student->attendances()->where('date',$date)->count() > 0)
                                                            checked
                                                        @endif
                                                        >
                                                    </td>
                                                @endif


                                            @endfor
                                        </tr>
                                        <input type="hidden" name="allStudents[]" value="{{$student->id}}">
                                    @endforeach

                                    </tbody>

                                </table>
                            </div>
                            {{Form::close()}}
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
        @endif
    </div>

@endsection



@section('scripts')

    <script>
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
        (function () {
            $('#dailySales').dataTable({
                order: [2, 'desc'],
                responsive: true,
            });


            $('.promoter_id').hide();
            $('.outlet_id').hide();
            //For Select By

            $('.select').change(function () {
                var val = $('.select').val();
                // alert(val);
                if (val == 'outlet_id') {
                    $('.promoter_id').hide();
                    $('.outlet_id').show();
                }
                if (val == 'promoter_id') {
                    $('.outlet_id').hide();
                    $('.promoter_id').show();
                }
            });


            $(document).on('submit', '.report-search', function (e) {

                e.preventDefault();


                $('.error-message').each(function () {
                    $(this).removeClass('make-visible');
                    $(this).html('');
                });


                $('input').each(function () {
                    $(this).removeClass('errors');
                });

                current_form = $(this);

                var url = $(this).attr('action');
                var request_data = {};
                request_data['_token'] = $(this).attr('data-token');

                current_form.find('[name]').each(function () {
                    request_data[$(this).attr('name')] = $(this).val();

                });
                // console.log(url);


                $('.loader-report img.loader').addClass('make-visible');
                $.post(url, request_data, function (response) {
                        // console.log(request_data);

                        $('.loader-report img.loader').removeClass('make-visible');
                        if (response.status == 'success') {
                            $('#load-report-results').html('');

                            $('#load-report-results').html(response.data);
                            $("body, html").animate({
                                scrollTop: $('#load-report-results').offset().top
                            }, 600);
                        }
                        if (response.status == 'fail') {
                            for (var key in response.errors) {
                                var error_message = response.errors[key];

                                var error_form_field = current_form.find("[name=" + key + "]");
                                error_form_field.addClass('errors');
                                error_form_field.parent().find('.error-message').addClass('make-visible').html(error_message);
                            }
                        }


                    }
                );

            });

        })();

    </script>

@endsection

