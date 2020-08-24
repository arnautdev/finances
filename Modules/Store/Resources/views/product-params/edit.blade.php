@extends('dashboard::layouts.master')

@section('content')

    <div class="form-horizontal form-bordered">
        {!! $form->panelStart(['title' => 'Product params']) !!}

        {{ Form::open(['route' => ['product-params.update', $data['productParam']->id], 'data-parsley-validate' => 'true']) }}
        @method('PUT')
        {!! $form->buttons() !!}

        {!! $form->input([
            'label' => 'Title',
            'name' => 'title',
            'model' => 'productParam',
            'data' => $data,
            'attrs' => [
                'required' => 'required'
            ]
        ]) !!}

        {!! $form->tagIt([
            'label' => 'Options',
            'name' => 'options',
            'model' => 'productParam',
            'data' => $data,
            'attrs' => [
                'required' => 'required'
            ]
        ]) !!}

        {!! $form->buttons() !!}
        {{ Form::close() }}


        {!! $form->panelEnd() !!}
    </div><!-- End ./form-horizontal -->

@endsection
