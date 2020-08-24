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

@if(isset($onlyInput) && $onlyInput == true)
    <textarea
            name="{{ $name }}"
            id="{{ str_slug($name) }}"
            class="form-control no-radius {{ (isset($class)) ? $class : '' }} {{ ($errors->has($name)) ? 'has-error' : '' }} redactor"
    @if(isset($attrs))
        @foreach($attrs as $key => $val)
            @if($key == 'placeholder')
                {{ $key }}="{{ __($val) }}"
            @else
                {{ $key }}="{{ $val }}"
            @endif
        @endforeach
    @endif
    >{{ $defaultValue }}</textarea>
@else
    <div class="form-group row">
        <label for="{{ str_slug($label) }}"
               class="col-md-{{ $lblg ?? 3 }} col-form-label text-right">
            {{ (isset($label)) ? __($label) : '' }}
            <b>[{{ strtoupper(app()->getLocale()) }}]</b>
        </label>

        <div class="col-md-{{ $lg ?? 6 }}">
            <textarea
                    rows="5"
                    name="{{ $name }}"
                    id="{{ str_slug($name) }}"
                    class="form-control no-radius {{ (isset($class)) ? $class : '' }} {{ ($errors->has($name)) ? 'has-error' : '' }}"
            @if(isset($attrs))
                @foreach($attrs as $key => $val)
                    @if($key == 'placeholder')
                        {{ $key }}="{{ __($val) }}"
                    @else
                        {{ $key }}="{{ $val }}"
                    @endif
                @endforeach
            @endif
            >{{ $defaultValue }}</textarea>

            <small class="err-msg">{{ $errors->first($name) }}</small>
        </div><!-- End ./col-lg-6 -->
    </div><!-- End ./form-group -->
@endif

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/jgow1a1psshl4mvavai25j4vzxz8vtohwaunozwseipopf23/tinymce/5/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '.redactor',
            height: 500,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        });
    </script>
@endpush
