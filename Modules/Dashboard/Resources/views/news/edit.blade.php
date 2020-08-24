@extends('dashboard::layouts.master')

@section('content')
    @include('dashboard::includes.component.panel-start', [
        'title' => [
            'Edit news: :title',
            ['title' => mb_strtoupper($data['news']->title)]
        ]
    ])

    <div class="form-horizontal form-bordered">
        {{ Form::open(['route' => ['news.update', $data['news']->id], 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data']) }}
        @method('PUT')
        @include('dashboard::includes.form.buttons')

        @include('dashboard::includes.form.checkbox',[
            'name' => 'isActive',
            'label' => 'Is active',
            'model' => 'news'
        ])

        @include('dashboard::includes.form.input', [
            'name' => 'title',
            'label' => 'Title',
            'model' => 'news',
            'attrs' => [
                'data-parsley-required' => 'true',
                'data-parsley-minlength' => 3,
            ]
        ])

        @include('dashboard::includes.form.textarea', [
            'name' => 'description',
            'label' => 'Small description',
            'model' => 'news',
        ])

        @include('dashboard::includes.form.textarea', [
            'name' => 'content',
            'label' => 'Content',
            'model' => 'news',
            'class' => 'redactor',
            'attrs' => [
                'data-parsley-required' => 'true',
                'data-parsley-minlength' => 3,
            ]
        ])

        @include('dashboard::includes.form.input', [
            'name' => 'videoUrl',
            'label' => 'Video url',
            'model' => 'news'
        ])

        <div class="form-group row">
            <label for="choice-media" class="col-lg-3 col-form-label text-right">{{ __('Media') }}</label>
            <div class="col-lg-6">
                <input type="file"
                       name="newsImages[]"
                       class="btn btn-sm btn-secondary"
                       multiple="multiple"
                />
            </div><!-- End ./col-lg-6 -->
        </div><!-- End ./form-group -->
        @if($data['news']->getMedia('newsImages')->count() > 0)
            <div class="form-group row">
                <label class="col-lg-3 col-form-label text-right">{{ __('Added files') }}</label>
                <div class="col-lg-6">
                    <div class="row gallery-sortable" data-save-order="{{ route('media.save-order') }}">
                        @foreach($data['news']->getMedia('newsImages') as $media)
                            <div class="col-lg-3 cursor-pointer" data-id="{{ $media->id }}">
                                <img src="{{ $media->getUrl('newsImageSmall') }}"
                                     class="img-fluid"
                                />
                                <a href="{{ route('media.destroy', $media->id) }}"
                                   class="btn btn-xs btn-danger btn-block no-radius">
                                    <i class="fa fa-trash"></i>&nbsp;
                                    {{ __('Delete') }}
                                </a>
                            </div><!-- End ./col-lg-2 -->
                        @endforeach
                    </div>
                </div>
            </div><!-- End ./form-group -->
        @endif

        @include('dashboard::includes.form.buttons')
        {{ Form::close() }}
    </div><!-- End ./form-bordered -->

    @include('dashboard::includes.component.panel-end')
@endsection
