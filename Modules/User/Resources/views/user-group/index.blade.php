@extends('dashboard::layouts.master')

@section('content')

    @include('dashboard::includes.component.panel-start', ['title' => 'Existing groups'])

    @include('dashboard::includes.form.buttons')

    <div class="table-responsive">
        <table class="table table-striped table-bordered no-radius table-hover">
            <thead>
            <tr>
                <th>{{ __('id') }}</th>
                <th>{{ __('group-name') }}</th>
                <th>{{ __('actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['roles'] as $role)
                <tr>
                    <td>{{ link_to(route('user-group.edit', [$role->id]), $role->id) }}</td>
                    <td>{{ link_to(route('user-group.edit', [$role->id]), $role->name) }}</td>
                    <td>
                        {{ Form::open(['route' => ['user-group.destroy', $role->id], 'method' => 'DELETE']) }}
                        <input type="hidden" name="id" value="{{ $role->id }}">
                        <button type="submit" class="btn btn-xs btn-danger no-radius">
                            <i class="fa fa-trash"></i>&nbsp;
                            {{ __('destroy') }}
                        </button>
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>{{-- End ./table-responsive --}}

    @include('dashboard::includes.component.panel-end')

@endsection