@extends('backend.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Student Strength
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Student Strength</a></li>
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
                        {{--<button type="button" class="btn btn-primary ajax-modal"--}}
                        {{--data-url="{{ action('Backend\BrandController@create') }}"--}}
                        {{--style="position: absolute;right: 10px;top: 10px;">--}}
                        {{--+ New Brand--}}
                        {{--</button>--}}
                        <!-- /.box-header -->
                            <div class="box-body reload">
                                <table id="brand" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classrooms as $key => $classroom)
                                        @foreach($classroom->sections()->orderBy('name','ASC')->get() as $key =>  $section)
                                            <tr>

                                                @if($key == 0)
                                                    <td rowspan="{{$classroom->sections_count+1}}">{{$classroom->name}}</td>
                                                @endif

                                                <td>
                                                    {{$section->name}}
                                                </td>
                                                <td>
                                                    {{$section->students()->where('gender','Female')->count()}}
                                                </td>
                                                <td>
                                                    {{$section->students()->where('gender','Male')->count()}}
                                                </td>
                                                <td>
                                                    {{$section->students()->count()}}
                                                </td>
                                            </tr>

                                        @endforeach
                                        <tr>
                                            <th>
                                                Total
                                            </th>
                                            <th> {{$classroom->sections()->orderBy('name','ASC')->with(['students' => function($query){
                                                return $query->where('gender','Female')->where('status','Active');
                                                }])->get()->pluck('students')->collapse()->count()}}</th>
                                            <th>
                                                {{$classroom->sections()->orderBy('name','ASC')->with(['students' => function($query){
                                            return $query->where('gender','Male')->where('status','Active');
                                            }])->get()->pluck('students')->collapse()->count()}}
                                            </th>
                                            <th>
                                            {{$classroom->sections()->orderBy('name','ASC')->with(['students' => function($query){
                                                return $query->where('status','Active');
                                                }])->get()->pluck('students')->collapse()->count()}}
                                            </th>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="2">
                                            Grand Total
                                        </th>
                                        <th>
                                            {{$femaleCount}}

                                        </th>
                                        <th>
                                            {{$maleCount}}
                                        </th>
                                        <th>
                                            {{ $classrooms->pluck('sections')
                                            ->collapse()
                                            ->pluck('students')->collapse()
                                            ->count() }}
                                        </th>
                                    </tr>
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