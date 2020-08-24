@extends('dashboard::layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-8">
            @include('dashboard::includes.component.panel-start', [
                'title' => [
                    'Edit page: :title',
                    ['title' => strtoupper($data['page']->title)]
                ]
            ])

            <div class="form-horizontal form-bordered">
                {{ Form::open(['route' => ['text-page-section.update', $data['page']->id], 'data-parsley-validate' => 'true']) }}
                @method('PUT')
                @include('dashboard::includes.form.buttons', [
                    'lblg' => 2,
                    'backUrl' => route('text-page.edit', $data['page']->pageId)
                ])

                @include('dashboard::includes.form.checkbox', [
                    'label' => 'Is Active',
                    'name' => 'isActive',
                    'model' => 'page',
                    'lblg' => 2,
                ])

                @include('dashboard::includes.form.input', [
                    'label' => 'Title',
                    'name' => 'title',
                    'model' => 'page',
                    'lblg' => 2,
                    'lg' => 9,
                    'attrs' => [
                        'data-parsley-required' => 'true',
                        'data-parsley-minlength' => 3,
                    ]
                ])

                @include('dashboard::includes.form.textarea', [
                    'label' => 'Small description',
                    'name' => 'description',
                    'model' => 'page',
                    'lblg' => 2,
                    'lg' => 9,
                ])

                @include('dashboard::includes.form.textarea', [
                    'label' => 'Content',
                    'name' => 'content',
                    'model' => 'page',
                    'class' => 'redactor',
                    'lblg' => 2,
                    'lg' => 9,
                    'attrs' => [
                        'data-parsley-required' => 'true',
                        'data-parsley-minlength' => 10,
                    ]
                ])

                @include('dashboard::includes.form.buttons', [
                    'lblg' => 2,
                    'backUrl' => route('text-page.edit', $data['page']->pageId)
                ])
                {{ Form::close() }}
            </div><!-- End ./form-bordered -->
            @include('dashboard::includes.component.panel-end')
        </div><!-- End ./col-8 -->

        <div class="col-lg-4">
            {{ Form::open(['route' => ['text-page-section.update', $data['page']->id], 'enctype' => 'multipart/form-data']) }}
            @method('PUT')
            @include('dashboard::includes.page-media')
            {{ Form::close() }}

        </div><!-- End ./col-lg-4 -->

    </div><!-- End ./row -->

@endsection