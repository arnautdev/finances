@extends('dashboard::layouts.master')

@section('content')

    {!! $form->panelStart(['title' => 'Product params']) !!}
    {!! $form->buttons() !!}

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>{{ __('#Id') }}</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Params') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>

        <tbody>
        @foreach($data['productParams'] as $productParam)
            <tr>
                <td>{{ $productParam->id }}</td>
                <td>{{ $productParam->title }}</td>
                <td>{{ $productParam->options }}</td>
                <td>
                    {!! $form->tableActions([
                        'editAction' => ['product-params.edit',$productParam->id],
                        'deleteAction' => ['product-params.destroy',$productParam->id]
                    ]) !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $form->panelEnd() !!}

@endsection
