@extends('backend.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Class Promotion
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Class Promotion</a></li>
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
                                <h3 class="box-title">Class Promotion</h3>
                            </div>

                            {!! Form::open([
                                'action' => 'Backend\ClassPromotionController@store',
                                'method' => 'POST',
                                'class' => 'form-horizontal ajax-form-post',
                                'files' => true
                            ]) !!}

                            @include('backend.classPromotion.form')

                            <div class="box-footer text-right">
                                <button type="submit" class="btn btn-warning">Promote</button>
                            </div>


                            {!! Form::close() !!}

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
        $("#select_all").click(function(){
            if($("#select_all").is(':checked') ){
                $(".select2 > option").prop("selected","selected");
                $(".select2").trigger("change");
            }else{
                $(".select2").val(null).trigger("change");
            }
        });
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

            $(".select2").val(null).trigger("change");

        });
        $(document).on('change', '.promotion_classroom', function () {
            $('.promotion_section').empty();
            $('.promotion_section').append('<option value="">Loading...</option>');
            var classroomId = $(this).val();
            var url = APP_URL + '/admin/periods/sections/' + classroomId;
            console.log(url);
            $.get(url, function (data) {
                $('.promotion_section').empty();
                $('.promotion_section').append('<option value="">--Select Any One--</option>');
                $.each(data, function (i, item) {
                    $('.promotion_section').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                });

            })

        });
        $(document).on('change', '.section', function () {
            $('.students').empty();
            $('.students').append('<option value="">Loading...</option>');
            var sectionId = $(this).val();
            var url = APP_URL + '/admin/classPromotion/students/' + sectionId;
            console.log(url);
            $.get(url, function (data) {
                $('.students').empty();
                // $('.students').append('<option value="">--Select Any One--</option>');
                $.each(data, function (i, item) {
                    $('.students').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                });
            })
            $(".select2").val(null).trigger("change");

        });

    </script>
    @endsection
