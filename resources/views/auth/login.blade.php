@extends('layouts.empty', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('content')
    <!-- begin login -->
    <div class="login login-with-news-feed">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image" style="background-image: url('/images/login-bg-2.jpg')"></div>
            <div class="news-caption">
                <h4 class="caption-title">{{ config('app.name') }}</h4>
                <p>{{ __('App name intro text login page') }}</p>
            </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
        @include('components.flash-messages')
        <!-- begin login-header -->
            <div class="login-header">
                <div class="brand">
                    <b>{{ config('app.name') }}</b>
                    <small>{{ __('Sign in to start tour session.') }}</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in-alt"></i>
                </div>
            </div>
            <!-- end login-header -->
            <!-- begin login-content -->
            <div class="login-content">
                <form action="{{ route('login') }}" method="POST" class="margin-bottom-0" data-parsley-validate="true">
                    @csrf
                    <div class="form-group m-b-15">
                        <input type="email" name="email"
                               class="form-control form-control-lg"
                               placeholder="{{ __('Email Address') }}"
                               required="required"
                        />
                    </div>
                    <div class="form-group m-b-15">
                        <input type="password" name="password"
                               class="form-control form-control-lg"
                               placeholder="{{ __('Password') }}"
                               required="required"
                        />
                    </div>
                    <div class="checkbox checkbox-css m-b-30">
                        <input type="checkbox" id="remember_me_checkbox" value=""/>
                        <label for="remember_me_checkbox">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">{{ __('Sign me in') }}</button>
                    </div>
                    <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                        {{ __('Not a member yet? Click') }}
                        <a href="{{ route('register') }}" class="text-success">{{ __('here') }}</a>
                        {{ __('to register.') }}
                    </div>
                    <hr/>
                    <p class="text-center text-grey-darker">
                        &copy; <b>{{ config('app.name') }}</b>
                        {{ __('All Right Reserved 2016 - :currentYear', ['currentYear' => date('Y')]) }}
                    </p>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end right-container -->
    </div>
    <!-- end login -->
@endsection
