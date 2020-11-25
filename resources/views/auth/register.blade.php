<x-guest-layout>
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

                {{ Form::open(['route' => 'register', 'data-parsley-validate' => 'true']) }}

                <div class="form-group mb-3">
                    {{ $form->input([
                        'onlyInput' => true,
                        'type' => 'text',
                        'name' => 'name',
                        'attrs' => [
                            'required' => 'required'
                        ]
                    ]) }}
                </div>

                <div class="form-group mb-3">
                    {{ $form->input([
                        'onlyInput' => true,
                        'type' => 'email',
                        'name' => 'email',
                        'attrs' => [
                            'required' => 'required'
                        ]
                    ]) }}
                </div>

                <div class="form-group mb-3">
                    {{ $form->input([
                        'onlyInput' => true,
                        'type' => 'password',
                        'name' => 'password',
                        'attrs' => [
                            'required' => 'required'
                        ]
                    ]) }}
                </div>

                <div class="form-group mb-3">
                    {{ $form->input([
                        'onlyInput' => true,
                        'type' => 'password',
                        'name' => 'password_confirmation',
                        'attrs' => [
                            'required' => 'required'
                        ]
                    ]) }}
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
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Sign Up') }}</button>
                    </div>
                    <!-- /.col -->
                </div>

                {{ Form::close() }}

                <div class="social-auth-links text-center mb-3">
                    <p>{{ __('- OR -') }}</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> {{ __('Sign up using Facebook') }}
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> {{ __('Sign up using Google+') }}
                    </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mb-0">
                    <a href="{{ route('welcome') }}" class="text-center">{{ __('Sign in') }}</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

</x-guest-layout>
