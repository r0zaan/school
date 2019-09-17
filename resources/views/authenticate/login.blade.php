<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Page</title>
    <link rel="shortcut icon" href="{{asset('img/cg.png')}}">
    <link rel="stylesheet" href="{{url('https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css')}}">
    <link rel="stylesheet" href="{{url('https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet"
          href="{{url('https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css')}}">
    <link rel="stylesheet"
          href="{{url('https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css')}}">
    <link rel="stylesheet"
          href="{{url('https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('login/assets/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('login/assets/css/style.css')}}">
    {{--<link rel="stylesheet" href="{{asset('css/backend.css')}}">--}}
    <style>
        .error-message {
            display: none;
            padding: 3px 8px;
            color: #fff;
            background-color: #dd4b39;
            margin-top: 12px;
            font-size: 13px;
            border-radius: 3px;
            position: relative;
        }

        .error-message:after, .help-block:after {
            content: "";
            border-left: 4px solid transparent;
            position: absolute;
            border-bottom: 4px solid #dd4b39;
            border-right: 4px solid transparent;
            left: 12px;
            top: -4px;
        }

        .make-visible {
            display: inline-block;
        }

        .errors {
            border-color: red;
        }
        .login-form{
            box-shadow: 0px 0px 5px #18306d;
        }

    </style>

    <link href="{{url('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800')}}" rel='stylesheet'
          type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body style="
    background: url('unnati/img/lin-txtr.png') no-repeat;
    background-size: cover;
    background-position: center;
    background-color: #ffffff;
    width: 100%;
    height: 100%;">

<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="{{route('login')}}">
                    <h3> Login Page</h3>
                    {{--<img class="align-content" src="{{url('unnati/img/logo.png')}}" height="200px" alt="">--}}
                </a>
            </div>
            <div class="login-form">
                {!! Form::open([
                    'action' => 'AuthsController@login',
                    'method' => 'POST',
                    'class' => 'ajax-form-post'

                ]) !!}

                <div class="form-group">
                    <label>Email address</label>
                    {{ Form::text('email',null,['class'=>'form-control form-ajax','placeholder'=>'Email'])}}
                    <span class="error-message"></span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    {{ Form::password('password',['class'=>'form-control form-ajax','placeholder'=>'Password']) }}
                    <span class="error-message"></span>
                </div>
                <div class="checkbox">
                    {{--<label>--}}
                    {{--<input type="checkbox"> Remember Me--}}
                    {{--</label>--}}
                    {{--<label class="pull-right">--}}
                    {{--<a href="#">Forgotten Password?</a>--}}
                    {{--</label>--}}

                </div>
                <button type="submit" class="btn btn-info btn-flat m-b-30 m-t-30">Login</button>
                <br>
                <div id="match" style="color:red">

                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
<script src="{{asset('AdminLTE/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{url('https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{url('https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js')}}"></script>
<script src="{{asset('login/assets/js/main.js')}}"></script>
<script type="text/javascript">
    (function ($) {

        $(document).on('submit', '.ajax-form-post', function () {

            $('.error-message').each(function () {
                $(this).removeClass('make-visible');
                $(this).html('');
            });


            $('input').each(function () {
                $(this).removeClass('errors');
            });

            var url = $(this).attr('action');

            var current_form = $(this);

            var request_data = {};

            current_form.find('[name]').each(function () {
                request_data[$(this).attr('name')] = $(this).val();

            });


            $.post(url, request_data, function (response) {
                console.log(response);
                if (response.status == 'success') {
                    window.location.href = response.return_url;
                }
                if (response.status == 'fail') {

                    for (var key in response.errors) {
                        var error_message = response.errors[key];

                        var error_form_field = current_form.find("[name=" + key + "]");
                        error_form_field.addClass('errors');
                        error_form_field.parent().find('.error-message').addClass('make-visible').html(error_message);
                    }
                    if (response.data != null) {
                        $('#match').html(response.data);
                    }
                }

            });

            return false;

        });

        $(document).on('keyup', '.form-ajax', function () {
            $('#match').html('');
        });
    })(jQuery);
</script>

</body>
</html>

