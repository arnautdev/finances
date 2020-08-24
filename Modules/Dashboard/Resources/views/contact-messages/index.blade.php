@extends('dashboard::layouts.master')

@section('content')
    @include('dashboard::includes.component.panel-start', [
        'title' => 'Contact form messages'
    ])

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>{{__('#Id')}}</th>
            <th>{{__('Created At')}}</th>
            <th>{{__('Name')}}</th>
            <th>{{__('E-mail')}}</th>
            <th>{{__('Message')}}</th>
        </tr>
        </thead>

        <tbody>
        @foreach($data['messages'] as $message)
            <tr>
                <td>{{ $message->id }}</td>
                <td>{{ $message->create_at }}</td>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->message }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('dashboard::includes.component.panel-end')
@endsection