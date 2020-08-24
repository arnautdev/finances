<div class="well">
    <div class="form-group">
        <h2>{{ __('My settings') }}</h2>
    </div>

    {{ Form::model($data['user'], ['route' => ['profile.update', auth()->id()], 'files' => true, 'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true']) }}
    @method('PATCH')

    @include('includes.form.select', [
        'name' => 'language',
        'model' => 'user',
        'label' => 'User language',
        'options' => config('app.locales'),
        'attrs' => [
            'data-parsley-required' => 'true'
        ]
    ])

    @include('includes.form.input', [
        'type' => 'file',
        'name' => 'avatar',
        'label' => 'User avatar'
    ])

    @include('includes.form.input', [
        'type' => 'text',
        'name' => 'firstname',
        'model' => 'user',
        'label' => 'First name',
        'attrs' => [
            'data-parsley-required' => 'true'
        ]
    ])

    @include('includes.form.input', [
        'type' => 'text',
        'name' => 'lastname',
        'model' => 'user',
        'label' => 'Last name',
        'attrs' => [
            'data-parsley-required' => 'true'
        ]
    ])

    @include('includes.form.input', [
        'type' => 'text',
        'name' => 'company',
        'model' => 'user',
        'label' => 'Company',
        'attrs' => [
            'data-parsley-required' => 'true'
        ]
    ])

    @include('includes.form.input', [
        'type' => 'text',
        'name' => 'phone',
        'model' => 'user',
        'label' => 'Phone',
        'attrs' => [
            'data-parsley-required' => 'true'
        ]
    ])

    {{--<div class="form-group row">--}}
    {{--<label class="col-md-1 col-form-label text-right">--}}
    {{--{{ __('user.timezone') }}--}}
    {{--</label>--}}
    {{--<div class="col-lg-6">--}}
    {{--{!! Timezone::selectForm( auth()->user()->timezone, null, array('class' => 'form-control', 'name' => 'timezone')) !!}--}}
    {{--</div><!-- End ./col-lg-6 -->--}}
    {{--</div>--}}

    <div class="form-group row">
        <label class="col-md-3 col-form-label text-right"></label>
        <div class="col-lg-6">
            {{ Form::submit(__('Save changes'), ['class' => 'btn btn-sm btn-primary no-radius']) }}
        </div><!-- End ./col-lg-6 -->
    </div><!-- End ./form-group -->

    {{ Form::close() }}
</div>