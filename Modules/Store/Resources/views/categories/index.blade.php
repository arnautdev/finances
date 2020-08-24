@extends('dashboard::layouts.master')

@section('content')

    {!! $form->panelStart(['title' => 'Existing categories']) !!}

    {!! $form->buttons() !!}

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>{{ __('Title') }}</th>
            <th>{{ __('isActive') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>

        <tbody>
        @foreach($data['categories'] as $category)
            <tr>
                <td>{{ $category->title }}</td>
                <td>{{ $category->isActive }}</td>
                <td>
                    {!! $form->tableActions([
                        'editAction' => ['categories.edit', $category->id],
                        'deleteAction' => ['categories.edit', $category->id],
                    ]) !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $form->panelEnd() !!}

@endsection