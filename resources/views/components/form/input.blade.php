@php

    $name = $data['name'] ?? 'name';
    $type = $data['type'] ?? 'text';
    $label = $data['label'] ?? ucfirst($name);

    $attrs['class'] = 'form-control ';
    if(isset($data['class'])){
        $attrs['class'] = $attrs['class'] . $data['class'];
    }

    if(isset($data['required'])){
        $attrs['required'] = 'required';
    }

    if(isset($data['attrs'])){
        $attrs = array_merge($attrs, $data['attrs']);
    }
@endphp

<div class="form-group">
    {{ Form::label($name, __($label)) }}
    {{ Form::$type($name, old($name), $attrs) }}
</div>
<!-- End ./form-group -->
