@php
    $name = isset($name) ? $name : 'unknown';

    if(strpos($name, '[]') !== false){
        $trimName = str_replace('[]', '', $name);
    }

    $class = isset($class) ? $class : '';
    $label = isset($label) ? $label : '';

    $inputValue = '';
    if(isset($data[$trimName])){
        $inputValue = $data[$trimName];
    }

    if(isset($model) && isset($data[$model][$trimName])){
        $inputValue = $data[$model][$trimName];
    }

    if(old($trimName)){
        $inputValue = old($trimName);
    }

    if(request($trimName, false)){
        $inputValue = request($trimName);
    }

    if(isset($explode) && $explode == true && is_string($inputValue)){
        $inputValue = explode(',', $inputValue);
    }

    $isSelected = function($key) use ($inputValue) {
        if(is_array($inputValue) && in_array($key, $inputValue)){
            return true;
        }

        if($inputValue == $key){
            return true;
        }

        return false;
    }
@endphp

@if(isset($options))
    <select class="select2" multiple="multiple" name="{{ $name }}"
            style="width: 100%;">

        @foreach($options as $optionKey => $optionLabel)
            <option value="{{ $optionKey }}" @if($isSelected($optionKey)) selected="selected" @endif>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
@endif

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@endpush
