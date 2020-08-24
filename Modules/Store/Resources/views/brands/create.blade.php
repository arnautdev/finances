@extends('dashboard::layouts.master')

@section('content')

    {!! $form->panelStart([
        'title' => 'Create new brand'
    ]) !!}

    <div class="form-horizontal form-bordered">

        {{ Form::open(['route' => ['brands.store'], 'data-parsley-validate' => 'true','enctype' => 'multipart/form-data']) }}

        {!! $form->buttons() !!}

        {!! $form->input([
            'label' => 'Title',
            'name' => 'title',
            'attrs' => [
                'required' => 'required',
                'data-parsley-minlength' => 3,
                'data-parsley-maxlength' => 100
            ]
        ]) !!}

        {!! $form->file([
            'label' => 'Brand image',
            'name' => 'attachments',
        ]) !!}

        {!! $form->buttons() !!}

        {{ Form::close() }}

    </div><!-- End ./form-horizontal -->

    {!! $form->panelEnd() !!}

@endsection