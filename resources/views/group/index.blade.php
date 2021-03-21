@extends('layouts.master')

@section('content')

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">{{ __('Available groups') }}</h4>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>{{ __('# Id') }}</th>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Created at') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data['roles'] as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td>
                            {{ $form->tableActions([
                                'id' => $role->id,
                                'editRoute' => 'group.edit',
                                'destroyRoute' => 'group.destroy',
                            ]) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- End ./panel-body -->
    </div>
    <!-- End ./panel-inverses -->

@endsection
