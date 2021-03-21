@extends('layouts.master')

@section('content')

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">{{ __('Available groups') }}</h4>
        </div>

        <div class="panel-body">

            {{ Form::open(['route' => ['group.update', $data['role']->id], 'class' => 'form-horizontal form-bordered']) }}
            @method('PUT')

            <div class="form-group row">
                <label class="col-lg-3 col-form-label text-right">{{ __('Permissions rules') }}</label>
                <div class="col-lg-6 table-responsive">
                    <table class="table table-bordered" id="permissions-table">
                        @foreach($data['permissions'] as $controller => $permission)
                            <tr class="bg-grey">
                                <th colspan="100">
                                    <div class="checkbox checkbox-css">
                                        <input type="checkbox"
                                               id="{{ $controller }}"
                                               class="main-permission-row"
                                               name="permissions[{{ $controller }}][{{ $loop->index }}]"
                                               value="{{ $data['permissions'][$controller][0]['uri'] }}"
                                               @if(isset(old("permissions")[$controller][$loop->index]) || $data['role']->hasPermissionTo("{$data['permissions'][$controller][0]['action']} {$data['permissions'][$controller][0]['uri']}"))
                                               checked="checked"
                                            @endif
                                        />
                                        <label for="{{ $controller }}" class="cursor-pointer">
                                            <strong>{{ $data['permissions'][$controller][0]['module'] }}</strong> /
                                            {{ $controller }}
                                        </label>
                                    </div>
                                </th>
                            </tr>

                            @foreach(array_chunk($permission, 4) as $rows)
                                <tr>
                                    @foreach($rows as $row)
                                        <td>
                                            <div class="checkbox checkbox-css">
                                                <input type="checkbox"
                                                       id="{{ "{$controller}-{$row['action']}" }}"
                                                       class="{{ $controller }}"
                                                       name="permissions[{{ $controller }}][{{ ++$loop->parent->index }}]"
                                                       value="{{ "{$row['action']} {$row['uri']}" }}"
                                                       @if(isset(old("permissions")[$controller][$loop->parent->index]) || $data['role']->hasPermissionTo("{$row['action']} {$row['uri']}"))
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
                        @endforeach
                    </table>
                </div>
            </div><!-- End ./form-group row -->


            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fa fa-save"></i>&nbsp;
                    {{ __('Save permissions') }}
                </button>
            </div>
            <!-- End ./form-group -->
            {{ Form::close() }}
        </div>
    </div>

@endsection
