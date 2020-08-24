@php
    $defaultValue = (isset($defaultValue)) ? $defaultValue : '';
    if (isset($model)) {
        if (isset($data[$model][$name])) {
            $defaultValue = $data[$model][$name];
        }
    } else {
        if (isset($data[$name])) {
            $defaultValue = $data[$name];
        }
    }

    if (old($name)) {
        $defaultValue = old($name);
    }
@endphp

<div class="form-group row">
    <label for="{{ str_slug($label) }}" class="col-form-label col-lg-3 text-right cursor-pointer">
        {{ __($label) }}
    </label>
    <div class="col-lg-6">
        <div class="switcher">
            <input type="hidden" name="{{ $name }}" value="no">
            <input type="checkbox"
                   name="{{ $name }}"
                   id="{{ str_slug($label) }}"
                   value="yes"
                   @if($defaultValue == 'yes')
                   checked="checked"
                   @endif
                   class="cursor-pointer"
            />
            <label for="{{ str_slug($label) }}" class="cursor-pointer"></label>
        </div>
    </div><!-- End ./col-lg-6 -->
</div><!-- End ./form-group -->