@extends('dashboard::layouts.master')

@section('content')
    @include('dashboard::includes.component.panel-start', [
        'title' => 'Edit user'
    ])

    <div class="form-horizontal form-bordered">
        {{ Form::open(['route' => ['users.update', $data['user']->id], 'data-parsley-validate' => 'true']) }}
        @method('PUT')
        @include('dashboard::includes.form.buttons', [
            'buttons' => link_to('/user/force-sign-in/' . $data['user']->id, 'Sign in as: ' . $data['user']->fullname(), [
                'class' => 'btn btn-sm btn-primary no-radius pull-right'
            ])
        ])

        <div class="form-group row">
            <label for="" class="col-lg-3 col-form-label text-right">{{ __('User group') }}</label>
            <div class="col-lg-6">
                {{ Form::select('groupId', $data['roles'], $data['user']->getRoleId(), ['class' => 'form-control no-radius']) }}
            </div><!-- End ./col-lg-6 -->
        </div><!-- End ./form-group -->

        @include('dashboard::includes.form.input', [
            'type' => 'text',
            'name' => 'firstname',
            'label' => 'First name',
            'model' => 'user',
        ])

        @include('dashboard::includes.form.input', [
            'type' => 'text',
            'name' => 'lastname',
            'label' => 'First name',
            'model' => 'user',
        ])

        @include('dashboard::includes.form.input', [
            'type' => 'text',
            'name' => 'email',
            'label' => 'E-mail',
            'model' => 'user',
            'attrs' => [
                'readonly' => 'readonly'
            ]
        ])

        @include('dashboard::includes.form.buttons')

        {{ Form::close() }}
    </div><!-- End ./form-horizontal -->

    @include('dashboard::includes.component.panel-end')
@endsection