@extends('dashboard::layouts.master')

@section('content')

    @include('dashboard::includes.component.panel-start', [
        'title' => 'Email log'
    ])

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>{{ __('Subject') }}</th>
            <th>{{ __('From') }}</th>
            <th>{{ __('To') }}</th>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>

        <tbody>
        @foreach($data['emails'] as $email)
            <tr>
                <td>{{ $email->subject }}</td>
                <td>{{ $email->from }}</td>
                <td>{{ $email->to }}</td>
                <td>{{ $email->date }}</td>
                <td class="text-center">
                    <a href="{{ route('email-log.show', $email->id) }}" class="btn btn-xs btn-primary" target="_blank">
                        <i class="fa fa-eye"></i>
                        {{ __('show') }}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('dashboard::includes.component.panel-end')

@endsection