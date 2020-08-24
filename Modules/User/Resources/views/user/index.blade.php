@extends('dashboard::layouts.master')

@section('content')

    @include('dashboard::includes.component.panel-start', ['title' => 'Existing users'])

    @include('dashboard::includes.form.buttons')

    <table class="table table-striped table-bordered no-radius table-hover data-table">
        <thead>
        <tr>
            <th>{{ __('id') }}</th>
            <th>{{ __('name') }}</th>
            <th>{{ __('email') }}</th>
            <th>{{ __('role') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['users'] as $user)
            <tr>
                <td>{{ link_to(route('users.edit', $user->id), $user->id) }}</td>
                <td>{{ $user->fullname() }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->getRole() }}</td>
                <td>
                    {{ link_to('', __('Resend invitation')) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('dashboard::includes.component.panel-end')

@endsection