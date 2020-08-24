<div class="well">
    <div class="form-group">
        <h2>{{ __('Address') }}</h2>
    </div>
    <div class="form-horizontal form-bordered">
        @if(isset($data['userAddress']) && $data['userAddress']->exists())
            {{ Form::open(['route' => ['user-address.update', $data['userAddress']->id], 'data-parsley-validate' => 'true']) }}
            @method('PUT')
        @else
            {{ Form::open(['route' => 'user-address.store', 'data-parsley-validate' => 'true']) }}
        @endif

        @include('includes.form.input', [
            'type' => 'text',
            'name' => 'country',
            'label' => 'Country',
            'model' => 'userAddress',
            'attrs' => [
                'data-parsley-required' => 'true'
            ]
        ])

        @include('includes.form.input', [
            'type' => 'text',
            'name' => 'city',
            'label' => 'City',
            'model' => 'userAddress',
            'attrs' => [
                'data-parsley-required' => 'true'
            ]
        ])

        @include('includes.form.input', [
            'type' => 'text',
            'name' => 'postcode',
            'label' => 'Postcode',
            'model' => 'userAddress',
            'attrs' => [
                'data-parsley-required' => 'true'
            ]
        ])

        @include('includes.form.input', [
            'type' => 'text',
            'name' => 'address',
            'label' => 'Address',
            'model' => 'userAddress',
            'attrs' => [
                'data-parsley-required' => 'true'
            ]
        ])

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"></label>
            <div class="col-lg-6">
                {{ Form::submit(__('Save address'), ['class' => 'btn btn-sm btn-primary no-radius']) }}
            </div><!-- End ./col-lg-6 -->
        </div><!-- End ./form-group -->

        {{ Form::close() }}
    </div><!-- End ./form-horizontal -->
</div><!-- End ./well -->