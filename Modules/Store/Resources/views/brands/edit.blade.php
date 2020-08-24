@extends('dashboard::layouts.master')

@section('content')

    {!! $form->panelStart([
        'title' => [
            'Edit brand: <b>:brandName</b>',
            ['brandName' => $data['brand']->title]
        ]
    ]) !!}

    <div class="form-horizontal form-bordered">

        {{ Form::open(['route' => ['brands.update', $data['brand']->id], 'data-parsley-validate' => 'true','enctype' => 'multipart/form-data']) }}
        @method('PUT')
        {!! $form->buttons() !!}

        {!! $form->isActive([
            'label' => 'Is active',
            'name' => 'isActive',
            'model' => 'brand',
            'data' => $data,
        ]) !!}

        {!! $form->input([
            'label' => 'Title',
            'name' => 'title',
            'model' => 'brand',
            'data' => $data,
            'attrs' => [
                'required' => 'required',
                'data-parsley-minlength' => 3,
                'data-parsley-maxlength' => 100
            ]
        ]) !!}

        {!! $form->file([
            'label' => 'Brand image',
            'name' => 'attachments',
            'model' => 'brand',
            'data' => $data,
        ]) !!}

        {!! $form->buttons() !!}

        {{ Form::close() }}

    </div><!-- End ./form-horizontal -->

    {!! $form->panelEnd() !!}

@endsection