@extends('dashboard::layouts.master')

@section('content')
    @push('scripts')
        <script type="text/javascript"
                src="{{ asset('modules/plugins/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js') }}"></script>
    @endpush
    
    <link rel="stylesheet"
          href="{{ asset('modules/plugins/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}">
    @include('dashboard::includes.component.panel-start', [
        'title' => [
            'Translate labels :count',
            ['count' => count($columns[0])]
        ]
    ])

    <div class="form-group">
        {{ Form::open(['route' => 'translations.create', 'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true']) }}

        @include('includes.form.input', [
            'type' => 'text',
            'label' => 'Key',
            'name' => 'key',
            'attrs' => [
                'placeholder' => __("Key"),
                'data-parsley-required' => 'true',
            ]
        ])

        @include('includes.form.input', [
            'type' => 'text',
            'label' => 'Value',
            'name' => 'value',
            'attrs' => [
                'placeholder' => __("Value"),
                'data-parsley-required' => 'true',
            ]
        ])

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"></label>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-sm btn-primary no-radius">
                    <i class="fa fa-save"></i>&nbsp;
                    {{ __('common.save-item') }}
                </button>
            </div>
        </div><!-- End ./form-group -->

        {{ Form::close() }}
    </div><!-- End ./form-group -->

    <table class="table table-hover table-bordered table-striped lang-data-table">
        <thead>
        <tr>
            <th>Key</th>
            @if($languages->count() > 0)
                @foreach($languages as $kl=>$language)
                    <th>{{ __('Lang') }}({{ $language }})</th>
                @endforeach
            @endif
            <th width="80px;">Action</th>
        </tr>
        </thead>
        <tbody>
        @if($columnsCount > 0)
            @foreach($columns[0] as $columnKey => $columnValue)
                <tr>
                    <td>
                        <a href="#" class="translate-key" data-title="Enter Key" data-type="text"
                           data-pk="{{ $columnKey }}"
                           data-url="{{ route('translation.update.json.key') }}">
                            {{ $columnKey }}
                        </a>
                    </td>
                    @for($i=1; $i<=$columnsCount; ++$i)
                        <td><a href="#" data-title="Enter Translate" class="translate"
                               data-code="{{ $columns[$i]['lang'] }}" data-type="textarea" data-pk="{{ $columnKey }}"
                               data-url="{{ route('translation.update.json') }}">{{ isset($columns[$i]['data'][$columnKey]) ? $columns[$i]['data'][$columnKey] : '' }}</a>
                        </td>
                    @endfor
                    <td>
                        <button data-action="{{ route('translations.destroy', $columnKey) }}"
                                class="btn btn-danger btn-xs remove-key">Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    @include('dashboard::includes.component.panel-end')
@endsection