@php

    $selected = null;
    if (isset($model) && isset($data[$model][$name])) {
        $selected = $data[$model][$name];
    } elseif (isset($data[$name])){
        $selected = $data[$name];
    }

@endphp

@if(isset($options))

    <div class="form-group row">
        <label for="{{ str_slug($label) }}"
               class="col-md-{{ (isset($lg) && intval($lg) > 0) ? $lg : 3 }} col-form-label text-right">
            {{ __($label) }}
        </label>

        <div class="col-md-6">
            <select name="{{ $name }}"
                    id="{{ str_slug($label) }}"
                    class="form-control"
            @if(isset($attrs))
                @foreach($attrs as $key => $val)
                    {{ $key }}={{ $val }}
                @endforeach
            @endif
            >

            @foreach($options as $key => $val)
                @if(is_array($val))
                    <optgroup label="{{ str_slug($key) }}">
                        @foreach($val as $sKey => $sVal)
                            <option value="{{ $sKey }}" @if($selected == $key)selected="selected"@endif>
                                {{ $sVal }}
                            </option>
                        @endforeach
                    </optgroup>
                @else
                    <option value="{{ $key }}" @if($selected == $key)selected="selected"@endif >
                        {{ $val }}
                    </option>
                    @endif
                    @endforeach
                    </select>

                    <small class="err-msg">{{ $errors->first($name) }}</small>
        </div><!-- End ./col-lg-6 -->
    </div><!-- End ./form-group -->

@endif