@extends('dashboard::layouts.master')

@section('content')

    @include('dashboard::includes.component.panel-start', [
        'title' => 'Create new page'
    ])


    <div class="form-horizontal form-bordered">
        {{ Form::open(['route' => 'text-page.store', 'data-parsley-validate' => 'true']) }}
        
        @include('dashboard::includes.form.input', [
            'label' => 'Title',
            'name' => 'title',
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