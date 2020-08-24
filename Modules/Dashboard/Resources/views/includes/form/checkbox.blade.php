@if(isset($onlyInput) && $onlyInput === true)
    <input type="hidden" name="{{ $name }}" value="no">
    <input type="checkbox"
           id="{{ str_slug($name) }}"
           name="{{ $name }}"
           value="yes"
    />
@else
    <div class="form-group row">
        <label for="{{ str_slug($label) }}"
               class="col-md-{{ $lblg ?? 3 }} col-form-label text-right">
            {{ __($label) }}
        </label>

        <div class="col-md-{{ $lg ?? 6 }}">
            <!-- switcher -->
            <div class="switcher">
                <input type="hidden" name="{{ $name }}" value="no">
                <input type="checkbox"
                       id="{{ $name }}"
                       name="{{ $name }}"
                       value="yes"
                       @if(isset($data[$name]) && $data[$name] == 'yes')
                       checked="checked"
                       @endif

                       @if(isset($data[$model][$name]) && $data[$model][$name] == 'yes')
                       checked="checked"
                        @endif
                >
                <label for="{{ $name }}" class="cursor-pointer"></label>
            </div>

            <small class="err-msg">{{ $errors->first($name) }}</small>
        </div><!-- End ./col-lg-6 -->
    </div><!-- End ./form-group -->
@endif