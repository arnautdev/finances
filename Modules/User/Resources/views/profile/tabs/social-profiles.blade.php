<div class="well">
    <div class="form-group">
        <h2>{{ __('Social profiles') }}</h2>
    </div>

    <div class="form-horizontal form-bordered">
        {{ Form::open(['route' => 'social-pages.store', 'data-parsley-validate' => 'true']) }}

        @include('includes.form.select', [
            'name' => 'type',
            'label' => 'Social page type',
            'options' => config('app.social-pages'),
        ])


        @include('includes.form.input', [
            'type' => 'text',
            'name' => 'title',
            'label' => 'Title',
            'attrs' => [
                'data-parsley-required' => 'true',
                'data-parsley-minlength' => 3,
                'data-parsley-maxlength' => 100,
            ]
        ])


        @include('includes.form.input', [
            'type' => 'text',
            'name' => 'socialUrl',
            'label' => 'Url for page',
            'attrs' => [
                'data-parsley-required' => 'true',
                'data-parsley-type' => 'url'
            ]
        ])

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"></label>
            <div class="col-lg-6">
                {{ Form::submit(__('Add page'), ['class' => 'btn btn-sm btn-primary no-radius']) }}
            </div><!-- End ./col-lg-6 -->
        </div><!-- End ./form-group -->

        {{ Form::close() }}


        @if (isset($data['socialPages']) && $data['socialPages']->count() > 0)
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-right">
                    {{ __('Added social pages') }}
                </label>
                <div class="col-lg-6">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>{{ __('Page title') }}</th>
                                <th>{{ __('Created') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['socialPages'] as $socPage)
                                <tr>
                                    <td>{{ $socPage->title }}</td>
                                    <td>{{ $socPage->created_at }}</td>
                                    <td>
                                        <a href="#" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i>&nbsp;
                                            {{ __('destroy') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- End ./table-responsive -->
                </div><!-- End ./col-lg-7 -->
            </div><!-- End ./form-group -->
        @endif
    </div>
</div><!-- End ./well -->