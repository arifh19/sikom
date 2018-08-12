<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Alert -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset("/admin-lte/bootstrap/css/bootstrap.min.css") }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/ionicons-2.0.1/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('/ionicons-2.0.1/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("/admin-lte/dist/css/AdminLTE.min.css") }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/admin-lte/plugins/iCheck/square/blue.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}"><b>SI</b>KOMATIK</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            @include('layouts._flash')

            <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>
            @if(session()->has('status'))
            <div class="alert alert-info fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sukses </strong> {{ session('status') }}.
            </div>
        @endif 
        @if(session()->has('warning'))
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Gagal </strong> {{ session('warning') }}.
            </div>
        @endif 
            {!! Form::open(['url' => '/login']) !!}

                <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email','required']) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password','required']) !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>
                
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                {!! Form::checkbox('remember') !!} Ingat saya
                            </label>
                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            {!! Form::close() !!}
               
            <a href="{{ route('password.request') }}">Lupa password</a><br>
            <a href="{{ route('register') }}" class="text-center">Daftar baru</a>
           

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->


    <!-- jQuery 2.2.3 -->
    <script src="{{ asset("/admin-lte/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset("/admin-lte/bootstrap/js/bootstrap.min.js") }}"></script>

    <!-- iCheck -->
    <script src="{{ asset('admin-lte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
    <!-- Alert JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @include('sweet::alert')
  <center><strong>SIKOMATIK V 1.0<br>Copyright &copy; {!! date("Y") !!} <a href="http://komatik.wg.ugm.ac.id">SIKOMATIK</a>.</strong> All rights reserved.</center>
</body>
</html>
