@php
    $options = [];
    if(isset($model)  && isset($data[$model]) && $data[$model][$name]){
        $options = explode(',', $data[$model][$name]);
    }

    if(isset($name) && isset($data[$name])){
        $options = explode(',', $data[$name]);
    }
@endphp

<link rel="stylesheet" href="{{ asset('modules/plugins/tag-it/css/jquery.tagit.css') }}">
@push('scripts')
    <script type="text/javascript" src="{{ asset('modules/plugins/tag-it/js/tag-it.min.js') }}"></script>
@endpush

@if(isset($onlyInput) && $onlyInput)
    <ul id="jquery-tagIt" class="inverse" data-name="{{ $name ?? 'no-name' }}">
        @if(isset($options))
            @foreach($options as $option)
                <li>{{ $option }}</li>
            @endforeach
        @endif
    </ul>
@else
    <div class="form-group row">
        <label class="col-md-3 col-form-label text-right">{{ __($label ?? 'default-label') }}</label>
        <div class="col-lg-6">
            <ul class="inverse jquery-tagIt" data-name="{{ $name ?? 'no-name' }}">
                @if(isset($options))
                    @foreach($options as $option)
                        <li>{{ $option }}</li>
                    @endforeach
                @endif
            </ul>
        </div><!-- End ./col-lg-6 -->
    </div><!-- End ./form-group -->
@endif
