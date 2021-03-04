@php
    $name = isset($name) ? $name : 'unknown';
    $type = isset($type) ? $type : 'text';
    $class = isset($class) ? $class : '';
    $label = isset($label) ? __($label) : '';

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

    $defaultFormat = $format ?? 'YYYY-MM-DD';
    if(!isset($typeInput)){
        $typeInput = 'inline';
    }
@endphp

<div>
    @if(isset($typeInput) && $typeInput == 'inline')
        <div class="form-group row">
            <label class="col-sm-3 col-form-label text-right">{{ $label }}</label>
            <div class="col-lg-7">
                <textarea name="{{ $name }}" id="{{ $name }}" rows="7"
                          class="form-control {{ $class }}">{!! $inputValue !!}</textarea>
                <small class="err-msg">{{ $errors->first($name) }}</small>
            </div>
        </div>
        <!-- End form-group -->
    @endif

    @if(isset($typeInput) && $typeInput == 'standart')
        <div class="form-group">
            <label class="col-form-label">{{ $label }}</label>
            <textarea name="{{ $name }}" id="{{ $name }}" rows="7"
                      class="form-control {{ $class }}">{!! $inputValue !!}</textarea>
            <small class="err-msg">{{ $errors->first($name) }}</small>
        </div>
        <!-- End form-group -->
    @endif
</div>
