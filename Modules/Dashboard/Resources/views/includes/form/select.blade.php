@php
    $selected = null;
    if(!isset($name)){
        $name = 'no-name';
    }
    if(!isset($label)){
        $label = $name;
    }

    if (isset($model) && isset($data[$model][$name])) {
        $selected = $data[$model][$name];
    } elseif (isset($data[$name])){
        $selected = $data[$name];
    }


    $selectAttributes['name'] = $name ?? 'no-name';
    $selectAttributes['id'] = str_slug($selectAttributes['name']);
    $selectAttributes['class'] = 'form-control ' . $class ?? '';
    $attrs = $attrs ?? [];

    $printAttrs = function($rows) use ($attrs){
        if(is_array($attrs) && count($attrs) > 0){
            $rows = array_merge($rows, $attrs);
        }

        $output = '';
        foreach ($rows as $key => $item) {
            $output .= ''.$key.'="'.$item.'" ';
        }
        return $output;
    };
@endphp

@if(isset($options))
    @if(isset($onlyInput) && $onlyInput == true)
        <select {!! $printAttrs($selectAttributes) !!}>
            @if(isset($emptyOption))
                <option value="{{ $emptyOption[0] }}">{{ __($emptyOption[1]) }}</option>
            @endif

            @foreach($options as $key => $val)
                @if(!is_numeric($key))
                    <optgroup label="{{ $key }}">
                        @foreach($val as $sKey => $sVal)
                            <option value="{{ $sKey }}"
                                    @if($selected == $sKey)selected="selected" @endif
                                    @if(isset($selectedArray) && in_array($sKey, $selectedArray))selected="selected"@endif

                            >
                                {{ $sVal }}
                            </option>
                        @endforeach
                    </optgroup>
                @else
                    <option value="{{ $key }}"
                            @if($selected == $key)selected="selected" @endif
                            @if(isset($selectedArray) && in_array($key, $selectedArray))selected="selected"@endif
                    >
                        {{ $val }}
                    </option>
                @endif
            @endforeach
        </select>
    @else
        <div class="form-group row">
            <label for="{{ $label ?? str_slug($label) }}"
                   class="col-md-{{ (isset($lg) && intval($lg) > 0) ? $lg : 3 }} col-form-label text-right">
                {{ $label ?? __($label) }}
            </label>

            <div class="col-md-6">
                <select {!! $printAttrs($selectAttributes) !!} >

                    @if(isset($emptyOption))
                        <option value="{{ $emptyOption[0] }}">{{ __($emptyOption[1]) }}</option>
                    @endif

                    @foreach($options as $key => $val)
                        @if(!is_numeric($key))
                            <optgroup label="{{ $key }}">
                                @foreach($val as $sKey => $sVal)
                                    <option value="{{ $sKey }}"
                                            @if($selected == $sKey)selected="selected" @endif
                                            @if(isset($selectedArray) && in_array($sKey, $selectedArray))selected="selected"@endif
                                    >
                                        {{ $sVal }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @else
                            <option value="{{ $key }}"
                                    @if($selected == $key)selected="selected" @endif
                                    @if(isset($selectedArray) && in_array($key, $selectedArray))selected="selected"@endif
                            >
                                {{ $val }}
                            </option>
                        @endif
                    @endforeach
                </select>

                <small class="err-msg">{{ $errors->first($name) }}</small>
            </div><!-- End ./col-lg-6 -->
        </div><!-- End ./form-group -->
    @endif

@endif
