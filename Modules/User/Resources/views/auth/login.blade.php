@extends('user::layouts.master')

@section('content')
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image" style="background-image: url(/images/login-bg/login-bg-2.jpg)"></div>
                <div class="news-caption">
                    <h4 class="caption-title"><b>{{ config('app.name') }}</b> Admin App</h4>
                    <p>
                        Download the Color Admin app for iPhone®, iPad®, and Android™.
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand">
                        <img src="{{ url('/images/logo/favicon.png') }}" height="63"/>&nbsp;
                        {{ config('app.name') }}
                    </div>
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">
                    {{ Form::open(['route' => 'login', 'data-parsley-validate' => 'true', 'class' => 'margin-bottom-0']) }}
                    <div class="form-group m-b-15">
                        <input type="text"
                               name="email"
                               class="form-control form-control-lg"
                               placeholder="{{ __('Email Address') }}"
                               required="required"
                        />
                    </div>
                    <div class="form-group m-b-15">
                        <input type="password"
                               name="password"
                               class="form-control form-control-lg"
                               placeholder="{{ __('Password') }}"
                               required="required"
                        />
                    </div>
                    <div class="checkbox checkbox-css m-b-30">
                        <input type="checkbox"
                               name="remember"
                               id="remember_me_checkbox"
                               value=""
                        />
                        <label for="remember_me_checkbox">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">
                            {{ __('Sign me in') }}
                        </button>
                    </div>
                    <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                        {{ __('Not a member yet? Click') }}
                        <a href="{{ route('register') }}" class="text-success">{{ __('here') }}</a> {{ __('to') }}
                        {{ __('register.') }}
                    </div>
                    <hr/>
                    <p class="text-center text-grey-darker">
                        &copy; <b>{{ config('app.name') }}</b>&nbsp;{{ __('All Right Reserved 2019') }}
                    </p>
                    {{ Form::close() }}
                </div><!-- end login-content -->
            </div><!-- end right-container -->
        </div><!-- end login -->
    </div><!-- End ./page-container -->
@endsection
