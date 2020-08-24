@extends('dashboard::layouts.master')

@section('content')

    @include('dashboard::includes.component.panel-start', ['title' => 'Existing groups'])

    {{ Form::open(['route' => 'user-group.store', 'class' => 'form-horizontal form-bordered']) }}

    @include('dashboard::includes.form.buttons')

    @include('dashboard::includes.form.input', [
        'type' => 'text',
        'label' => 'Group name',
        'name' => 'name',
    ])

    <div class="form-group row">
        <label class="col-lg-3 col-form-label text-right">{{ __('Permissions rules') }}</label>
        <div class="col-lg-6 table-responsive">
            <table class="table table-striped table-bordered" id="permissions-table">
                @foreach($data['permissions'] as $controller => $permission)
                    <tr>
                        <th colspan="100">
                            <div class="checkbox checkbox-css">
                                <input type="checkbox"
                                       id="{{ $controller }}"
                                       class="main-permission-row"
                                       name="permissions[{{ $controller }}][{{ $loop->index }}]"
                                       value="* {{ $data['permissions'][$controller][0]['uri'] }}"
                                       @if(isset(old("permissions")[$controller][$loop->index]))
                                       checked="checked"
                                        @endif
                                />
                                <label for="{{ $controller }}" class="cursor-pointer">{{ $controller }}</label>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        @foreach($permission as $row)
                            <td>
                                <div class="checkbox checkbox-css">
                                    <input type="checkbox"
                                           id="{{ "{$controller}-{$row['action']}" }}"
                                           class="{{ $controller }}"
                                           name="permissions[{{ $controller }}][{{ ++$loop->parent->index }}]"
                                           value="{{ "{$row['action']} {$row['uri']}" }}"
                                           @if(isset(old("permissions")[$controller][$loop->parent->index]))
                                           checked="checked"
                                            @endif
                                    />
                                    <label for="{{ "{$controller}-{$row['action']}" }}"
                                           class="cursor-pointer">
                                        {{ $row['action'] }}
                                    </label>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
    </div><!-- End ./form-group row -->

    @include('dashboard::includes.form.buttons')

    {{ Form::close() }}

    @include('dashboard::includes.component.panel-end')

@endsection