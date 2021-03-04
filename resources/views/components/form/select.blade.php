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

    if(isset($defaultValue)){
        $inputValue = $defaultValue;
    }

    if(!isset($options)){
        $options = [];
    }

    if(!isset($typeInput)){
        $typeInput = 'inline';
    }

    if(isset($onlyInput)){
        $typeInput = '';
    }

    // if(isset($emptyOption) && $emptyOption == true){
    //    $options['all'] = __('Select ...');
    // }
@endphp

<div>

    @if($typeInput == 'inline')
        <div class="form-group">
            <label for="{{ $name }}" class="col-sm-3 col-form-label text-right">
                {{ $label }}
            </label>
            <div class="col-sm-7">
                {{ Form::select($name, $options, $inputValue, [
                    'id' => $name,
                    'class' => 'form-control ' . $class
                ]) }}
                <small class="err-msg">{{ $errors->first($name) }}</small>
            </div>
        </div>
        <!-- End ./form-group -->
    @endif

    @if($typeInput == 'standart')
        <div class="form-group">
            <label for="{{ $name }}">{{ $label }}</label>
            {{ Form::select($name, $options, $inputValue, [
                'id' => $name,
                'class' => 'form-control ' . $class
            ]) }}
            <small class="err-msg">{{ $errors->first($name) }}</small>
        </div>
        <!-- End ./form-group -->
    @endif

    @if(isset($onlyInput) && $onlyInput == true)
        {{ Form::select($name, $options, $inputValue, [
            'id' => $name,
            'class' => 'form-control ' . $class
        ]) }}
        <small class="err-msg">{{ $errors->first($name) }}</small>
    @endif
</div>
