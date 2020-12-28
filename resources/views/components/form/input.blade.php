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
@endphp

<div>
    @if(isset($onlyInput) && $onlyInput == true)

        <input type="{{ $type }}"
               name="{{ $name }}"
               placeholder="{{ $placeholder }}"
               id="{{ $name }}"
               class="form-control {{  $class }}"

               @if(isset($required))
               required="required"
    @endif

    @if(isset($attrs))
        @foreach($attrs as $key => $val)
            {{ $key }}="{{ $val }}"
        @endforeach
    @endif

    value="{{ $inputValue }}"
    />
    <small class="err-msg">{{ $errors->first($name) }}</small>

    @elseif(isset($standartInput) && $standartInput == true)
        <div class="form-group">
            <label for="">{{ $label }}</label>
            <input type="{{ $type }}"
                   name="{{ $name }}"
                   placeholder="{{ $placeholder }}"
                   id="{{ $name }}"
                   class="form-control {{  $class }}"

                   @if(isset($required))
                   required="required"
            @endif

            @if(isset($attrs))
                @foreach($attrs as $key => $val)
                    {{ $key }}="{{ $val }}"
                @endforeach
            @endif

            value="{{ $inputValue }}"
            />
            <small class="err-msg">{{ $errors->first($name) }}</small>
        </div>
    @else
        <div class="form-group row">
            <label for="{{ $name }}" class="col-sm-3 col-form-label text-right">
                {{ $label }}
            </label>
            <div class="col-sm-7">
                <input type="{{ $type }}"
                       name="{{ $name }}"
                       placeholder="{{ $placeholder }}"
                       id="{{ $name }}"
                       class="form-control {{  $class }}"

                       @if(isset($required))
                       required="required"
                @endif

                @if(isset($attrs))
                    @foreach($attrs as $key => $val)
                        {{ $key }}="{{ $val }}"
                    @endforeach
                @endif

                value="{{ $inputValue }}"
                />

                <small class="err-msg">{{ $errors->first($name) }}</small>
            </div>
        </div><!-- End ./form-group -->

    @endif
</div>
