@if(isset($onlyInput) && $onlyInput === true)
    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ str_slug($name) }}"
           @if(isset($model))
           value="{{ (old($name)) ? old($name) : (isset($data[$model][$name]) ? $data[$model][$name] : '') }}"
           @else
           value="{{ (old($name)) ? old($name) : (isset($data[$name]) ? $data[$name] : '') }}"
           @endif
           class="form-control no-radius {{ (isset($class)) ? $class : '' }} {{ ($errors->has($name)) ? 'has-error' : '' }}"

    @if(isset($attrs))
        @foreach($attrs as $key => $val)
            {{ $key }}={{ $val }}
        @endforeach
    @endif
    />
@else
    <div class="form-group row">
        <label for="{{ str_slug($label) }}"
               class="col-md-{{ (isset($lg) && intval($lg) > 0) ? $lg : 3 }} col-form-label text-right">
            {{ __($label) }}
        </label>

        <div class="col-md-6">
            <input type="{{ $type }}"
                   name="{{ $name }}"
                   id="{{ str_slug($label) }}"
                   class="form-control no-radius {{ (isset($class)) ? $class : '' }} {{ ($errors->has($name)) ? 'has-error' : '' }}"
                   @if(isset($model))
                   value="{{ (old($name)) ? old($name) : (isset($data[$model][$name]) ? $data[$model][$name] : '') }}"
                   @else
                   value="{{ (old($name)) ? old($name) : (isset($data[$name]) ? $data[$name] : '') }}"
            @endif

            @if(isset($attrs))
                @foreach($attrs as $key => $val)
                    {{ $key }}={{ $val }}
                @endforeach
            @endif
            />

            <small class="err-msg">{{ $errors->first($name) }}</small>
        </div><!-- End ./col-lg-6 -->
    </div><!-- End ./form-group -->
@endif