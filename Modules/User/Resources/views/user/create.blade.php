@extends('dashboard::layouts.master')

@section('content')

    @include('dashboard::includes.component.panel-start', ['title' => 'Create user'])

    <div class="form-horizontal form-bordered">
        {{ Form::open(['route' => 'users.store', 'data-parsley-validate' => 'true']) }}

        <div class="form-group row">
            <label for="" class="col-form-label text-right col-lg-3">{{ __('Guard') }}</label>
            <div class="col-lg-6">
                {{ Form::select('guardId', config('auth.guardsNames')) }}
            </div>
        </div><!-- End ./row -->

        @include('dashboard::includes.form.input', [
            'name' => 'name',
            'label' => 'User name',
            'attrs' => [
                'data-parsley-required' => 'true',
                'data-parsley-minlength' => 3,
            ]
        ])

        @include('dashboard::includes.form.input', [
            'name' => 'email',
            'label' => 'Email',
            'attrs' => [
                'data-parsley-required' => 'true',
                'data-parsley-minlength' => 3,
            ]
        ])

        @include('dashboard::includes.form.buttons')

        {{ Form::close() }}
    </div><!-- End ./form-bordered -->

    @include('dashboard::includes.component.panel-end')

@endsection