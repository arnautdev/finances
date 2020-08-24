@extends('dashboard::layouts.master')

@section('content')

    {!! $form->panelStart([
        'title' => 'Existing brands'
    ]) !!}

    {!! $form->buttons() !!}

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>{{ __('Brand') }}</th>
            <th>{{ __('Is active') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>


        <tbody>
        @foreach($data['brands'] as $brand)
            <tr>
                <td>{{ $brand->title }}</td>
                <td>{{ $brand->isActive }}</td>
                <td>
                    {!! $form->tableActions([
                        'editAction' => ['brands.edit', $brand->id],
                        'deleteAction' => ['brands.destroy', $brand->id],
                    ]) !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $form->panelEnd() !!}

@endsection