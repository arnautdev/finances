@extends('dashboard::layouts.master')

@section('content')
    @include('dashboard::includes.component.panel-start', [
        'title' => 'Products'
    ])

    @include('dashboard::includes.form.buttons')


    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>{{ __('#Id') }}</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Created At') }}</th>
            <th>{{ __('Visible') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($data['products']))
            @foreach($data['products'] as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->isActive }}</td>
                    <td>
                        {!! $form->tableActions([
                            'editAction' => ['catalog.edit', $product->id],
                            'deleteAction' => ['catalog.destroy', $product->id],
                        ]) !!}
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    @include('dashboard::includes.component.panel-end')
@endsection
