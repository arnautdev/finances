<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ config('app.name') }} | {{ __('Login') }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">

<div class="login-box" id="dashboard-container">
    <div class="login-logo">
        <a href="{{ route('welcome') }}">
            <b>{{ config('app.name') }}</b>
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ __('Sign in to start your session') }}</p>

            {{ Form::open(['route' => 'login', 'data-parsley-validate' => 'true']) }}

            <div class="input-group mb-3">
                <input type="email" name="email" required="required" class="form-control" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" required="required" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
                </div>
                <!-- /.col -->
            </div>

            {{ Form::close() }}

            <div class="social-auth-links text-center mb-3">
                <p>{{ __('- OR -') }}</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> {{ __('Sign in using Facebook') }}
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> {{ __('Sign in using Google+') }}
                </a>
            </div>
            <!-- /.social-auth-links -->

            <p class="mb-1">
                <a href="forgot-password.html">{{ __('I forgot my password') }}</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">{{ __('Register a new membership') }}</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>

<script type="text/javascript">
    var $appLocale = '{{ app()->getLocale() }}';
</script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
