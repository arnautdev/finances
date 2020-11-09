@php
    $name = isset($name) ? $name : 'unknown';
    $type = isset($type) ? $type : 'text';
    $class = isset($class) ? $class : '';
    $label = isset($label) ? $label : '';

    $placeholder = __(ucfirst($name));
    if(isset($placeholder)){
        $placeholder = __($placeholder);
    }

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
@endphp

<div>
    <div class="form-group row">

        <label class="col-sm-3 col-form-label text-right">
            {{ $label }}
        </label>
        <div class="col-sm-7">
            <input type="hidden" name="{{ $name }}" value="no"/>
            <div class="icheck-primary">
                <input type="checkbox"
                       name="{{ $name }}"
                       id="{{ $name }}"
                       class="{{  $class }}"
                       value="yes"

                       @if(isset($required))
                       required="required"
                       @endif
                           
                       @if($inputValue == 'yes')
                       checked="checked"
                @endif

                @if(isset($attrs))
                    @foreach($attrs as $key => $val)
                        {{ $key }}="{{ $val }}"
                    @endforeach
                @endif

                />
                <label for="{{ $name }}"></label>

                <small class="err-msg">{{ $errors->first($name) }}</small>
            </div>
        </div>
    </div><!-- End ./form-group -->
</div>
