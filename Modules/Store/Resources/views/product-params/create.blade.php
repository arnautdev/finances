@extends('dashboard::layouts.master')

@section('content')

    <div class="form-horizontal form-bordered">
        {!! $form->panelStart(['title' => 'Product params']) !!}

        {{ Form::open(['route' => 'product-params.store', 'data-parsley-validate' => 'true']) }}
        {!! $form->buttons() !!}

        {!! $form->input([
            'label' => 'Title',
            'name' => 'title',
            'attrs' => [
                'required' => 'required'
            ]
        ]) !!}

        {!! $form->tagIt([
            'label' => 'Options',
            'name' => 'options',
            'attrs' => [
                'required' => 'required'
            ]
        ]) !!}

        {!! $form->buttons() !!}
        {{ Form::close() }}


        {!! $form->panelEnd() !!}
    </div><!-- End ./form-horizontal -->

@endsection
