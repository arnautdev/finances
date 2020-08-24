@extends('dashboard::layouts.master')

@section('content')

    <div class="form-horizontal form-bordered">
        {!! $form->panelStart(['title' => 'Create category']) !!}

        {{ Form::open(['route' => ['categories.store'], 'data-parsley-validate' => true, 'enctype' => 'multipart/form-data']) }}
        {!! $form->buttons() !!}

        {!! $form->input([
            'label' => 'Title',
            'name' => 'title',
            'attrs' => [
                'required' => 'required',
                'data-parsley-minlength' => 3,
                'data-parsley-maxlength' => 500,
            ]
        ]) !!}

        {!! $form->textarea([
            'label' => 'Description',
            'name' => 'description'
        ]) !!}

        {!! $form->textarea([
            'label' => 'Content',
            'name' => 'content',
            'class' => 'redactor'
        ]) !!}

        {!! $form->file([
            'label' => 'Product category image',
            'name' => 'attachments',
            'class' => 'btn-block'
        ]) !!}

        {!! $form->buttons() !!}
        {{ Form::close() }}


        {!! $form->panelEnd() !!}
    </div><!-- End ./form-horizontal -->

@endsection