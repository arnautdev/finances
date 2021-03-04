@php
    $inputName = isset($name) ? $name : 'toDate';

    $requestVal = request()->get($inputName, null);
    if(is_null($requestVal)){
        $requestVal = date('Y-m-01') .' - ' . date('Y-m-d');
    }

    if(!isset($typeInput)){
        $typeInput = 'inline';
    }
@endphp

@if(isset($typeInput) && $typeInput == 'inline')
    <div class="col-lg-{{ $lg ?? 3 }}">
        <div class="form-group">
            <label>{{ __('Date range:') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="text"
                       name="{{ $inputName }}"
                       class="form-control float-right"
                       id="daterangepicker"
                       value="{{ $requestVal }}"
                />
            </div>
            <!-- /.input group -->
        </div>
    </div><!-- End ./col -->
@endif

@if(isset($typeInput) && $typeInput == 'standart')
    <div class="form-group">
        <label>{{ __('Date range:') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
            </div>
            <input type="text"
                   name="{{ $inputName }}"
                   class="form-control float-right"
                   id="daterangepicker"
                   value="{{ $requestVal }}"
            />
        </div>
        <!-- /.input group -->
    </div>
@endif
