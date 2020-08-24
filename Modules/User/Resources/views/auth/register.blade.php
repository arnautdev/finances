@extends('user::layouts.master')
@section('content')
    <!-- begin register -->
    <div class="register register-with-news-feed">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image" style="background-image: url(/images/login-bg/login-bg-7.jpg)"></div>
            <div class="news-caption">
                <h4 class="caption-title"><b>{{ config('app.name') }}</b> App</h4>
                <p>
                    As a <b>{{ config('app.name') }}</b> app administrator, you use the Color Admin console to manage
                    your organization’s
                    account, such as add new users, manage security settings, and turn on the services you want your
                    team to access.
                </p>
            </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
        @include('dashboard::includes.component.flash')

        <!-- begin register-header -->
            <h1 class="register-header">
                {{ __('Sign Up') }}
                <small>{{ __('Create your '. config('app.name') .' Account. It’s free and always will be.') }}</small>
            </h1>
            <!-- end register-header -->
            <!-- begin register-content -->
            <div class="register-content">
                {{ Form::open(['route' => 'register', 'data-parsley-validate' => 'true', 'class' => 'margin-bottom-0']) }}

                <label class="control-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                <div class="row row-space-10">
                    <div class="col-md-6 m-b-15">
                        <input type="text"
                               name="firstname"
                               class="form-control"
                               placeholder="{{ __('First name') }}"
                               required="required"
                        />
                    </div>
                    <div class="col-md-6 m-b-15">
                        <input type="text"
                               name="lastname"
                               class="form-control"
                               placeholder="{{ __('Last name') }}"
                               required="required"
                        />
                    </div>
                </div>

                <label class="control-label">{{ __('Company') }} <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input type="text"
                               name="company"
                               class="form-control"
                               placeholder="Company name"
                               required="required"
                        />
                    </div>
                </div>

                <label class="control-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input type="text"
                               name="email"
                               class="form-control"
                               placeholder="{{ __('Email address') }}"
                               required="required"
                        />
                    </div>
                </div>

                <label class="control-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Password"
                               required="required"
                        />
                    </div>
                </div>

                <label class="control-label">{{ __('Re-Enter password') }} <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="Password"
                               required="required"
                        />
                    </div>
                </div>

                <div class="checkbox checkbox-css m-b-30">
                    <div class="checkbox checkbox-css m-b-30">
                        <input type="checkbox" id="agreement_checkbox" value="">
                        <label for="agreement_checkbox">
                            {{ __('By clicking Sign Up, you agree to our') }}
                            <a href="javascript:;">{{ __('Terms') }}</a>
                            {{ __('and that you have') }}
                            {{ __('read our') }}
                            <a href="javascript:;">{{ __('Data Policy') }}</a>, {{ __('including our') }}
                            <a href="javascript:;">{{ __('Cookie Use') }}</a>.
                        </label>
                    </div>
                </div>

                <div class="register-buttons">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">{{ __('Sign Up') }}</button>
                </div>
                <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                    {{ __('Already a member? Click') }}
                    <a href="{{ route('login') }}">{{ __('here') }}</a> {{ __('to login.') }}
                </div>
                <hr/>
                <p class="text-center">
                    &copy; <b>{{ config('app.name') }}</b>&nbsp;{{ __('All Right Reserved 2019') }}
                </p>

                {{ Form::close() }}
            </div>
            <!-- end register-content -->
@endsection
