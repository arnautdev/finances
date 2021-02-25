@php
    $name = isset($name) ? $name : 'unknown';
    $class = isset($class) ? $class : '';
    $label = isset($label) ? $label : '';

    $inputValue = '';
    if(isset($data[$name])){
        $inputValue = $data[$name];
    }

    if(isset($model) && isset($data[$model][$name])){
        $inputValue = $data[$model][$name];
    }

    if(old($name)){
        $inputValue = old($name);
    }

    if(request($name, false)){
        $inputValue = request($name);
    }
@endphp

<div>

    @if(isset($onlyInput) && $onlyInput == true)
        <select name="{{ $name }}" id="{{ $name }}" class="form-control {{ $class }}">
            @if(isset($options))
                @if(isset($emptyOption) && $emptyOption == true)
                    <option value="all">{{ __('All') }}</option>
                @endif

                @foreach($options as $optionId => $optionVal)
                    <option value="{{ $optionId }}"
                            @if($inputValue == $optionId) selected="selected" @endif
                    >
                        {{ $optionVal }}
                    </option>
                @endforeach
            @endif
        </select>

        <small class="err-msg">{{ $errors->first($name) }}</small>
    @else
        <div class="form-group row">
            <label for="{{ $name }}" class="col-sm-3 col-form-label text-right">
                {{ $label }}
            </label>
            <div class="col-sm-7">
                <select name="{{ $name }}" id="{{ $name }}" class="form-control {{ $class }}">
                    @if(isset($options))
                        @if(isset($emptyOption) && $emptyOption == true)
                            <option value="all">{{ __('All') }}</option>
                        @endif

                        @foreach($options as $optionId => $optionVal)
                            <option value="{{ $optionId }}"
                                    @if($inputValue == $optionId) selected="selected" @endif
                            >
                                {{ $optionVal }}
                            </option>
                        @endforeach
                    @endif
                </select>

                <small class="err-msg">{{ $errors->first($name) }}</small>
            </div>
        </div><!-- End ./form-group -->
    @endif
</div>
