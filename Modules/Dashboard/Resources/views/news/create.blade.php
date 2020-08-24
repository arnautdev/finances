@extends('dashboard::layouts.master')

@section('content')
    @include('dashboard::includes.component.panel-start', [
        'title' => 'Added news'
    ])

    <div class="form-horizontal form-bordered">
        {{ Form::open(['route' => 'news.store', 'data-parsley-validate' => 'true']) }}

        @include('dashboard::includes.form.input', [
            'name' => 'title',
            'label' => 'Title',
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