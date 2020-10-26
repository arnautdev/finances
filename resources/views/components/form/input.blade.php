@php
    $name = $attributes->get('name', 'unknown');
    $type = $attributes->get('type', 'text');
    $class = $attributes->get('class', '');
    $label = $attributes->get('label', '');

    $placeholder = __(ucfirst($name));
    if(!is_null($attributes->get('placeholder'))){
        $placeholder = __($attributes->get('placeholder'));
    }
@endphp

<div>
    <div class="form-group row">
        <label for="{{ $name }}" class="col-sm-3 col-form-label text-right">
            {{ $label }}
        </label>
        <div class="col-sm-7">
            <input type="{{ $type }}"
                   placeholder="{{ $placeholder }}"
                   id="{{ $name }}"
                   class="form-control {{  $class }}"

                   @if($attributes->get('required'))
                   required="required"
                @endif
            />
        </div>
    </div><!-- End ./form-group -->
</div>
