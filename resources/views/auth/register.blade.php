@extends('layouts.empty', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('content')

    <!-- begin register -->
    <div class="register register-with-news-feed">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image" style="background-image: url('/images/login-bg-2.jpg')"></div>
            <div class="news-caption">
                <h4 class="caption-title">
                    <b>{{ config('app.name') }}</b>
                </h4>
                <p>{{ __('Register page intro description') }}</p>
            </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
        @include('components.flash-messages')
        <!-- begin register-header -->
            <h1 class="register-header">
                {{ __('Sign Up') }}
                <small>{{ __('Create your Color Account. It’s free and always will be.') }}</small>
            </h1>
            <!-- end register-header -->
            <!-- begin register-content -->
            <div class="register-content">
                <form action="{{ route('register') }}" method="POST" class="margin-bottom-0"
                      data-parsley-validate="true">
                    @csrf

                    <label class="control-label">{{ __('Your names') }} <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="name" placeholder="{{ __('Your names') }}"
                                   required="required"
                                   value="{{ old('name') }}"
                            />

                            @error('name')
                            <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <label class="control-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="{{ __('Email address') }}"
                                   required="required"
                                   value="{{ old('email') }}"
                            />
                            @error('email')
                            <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <label class="control-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control"
                                   placeholder="{{ __('Password') }}"
                                   required
                            />
                            @error('password')
                            <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <label class="control-label">{{ __('Re-Password') }} <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="{{ __('Password') }}"
                                   required/>

                            @error('password_confirmation')
                            <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="checkbox checkbox-css m-b-30">
                        <div class="checkbox checkbox-css m-b-30">
                            <input type="checkbox" id="agreement_checkbox" value="">
                            <label for="agreement_checkbox">
                                By clicking Sign Up, you agree to our
                                <a href="javascript:;">Terms</a>
                                and that you have read our
                                <a href="javascript:;">Data Policy</a>,
                                including our
                                <a href="javascript:;">Cookie Use</a>.
                            </label>
                        </div>
                    </div>
                    <div class="register-buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">{{ __('Sign Up') }}</button>
                    </div>
                    <div class="m-t-30 m-b-30 p-b-30">
                        {{ __('Already a member? Click') }}
                        <a href="{{ route('login') }}">{{ __('here') }}</a> {{ __('to login.') }}
                    </div>
                    <hr/>
                    <p class="text-center mb-0">
                        &copy; <b>{{ config('app.name') }}</b>
                        {{ __('All Right Reserved 2016 - :currentYear', ['currentYear' => date('Y')]) }}
                    </p>
                </form>
            </div>
            <!-- end register-content -->
        </div>
        <!-- end right-content -->
    </div>
    <!-- end register -->
@endsection

{{--@extends('layouts.app')--}}
{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
