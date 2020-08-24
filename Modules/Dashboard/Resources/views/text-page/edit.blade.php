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
                {{ Form::open(['route' => ['text-page.update', $data['page']->id], 'data-parsley-validate' => 'true']) }}
                @method('PUT')
                @include('dashboard::includes.form.buttons', [
                    'lblg' => 2
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
                    'lblg' => 2
                ])
                {{ Form::close() }}
            </div><!-- End ./form-bordered -->
            @include('dashboard::includes.component.panel-end')
        </div><!-- End ./col-8 -->

        <div class="col-lg-4">
            {{-- SUB PAGES --}}
            @include('dashboard::includes.component.panel-start', [
                'title' => 'Sub pages'
            ])

            {{ Form::open(['route' => 'text-page-section.store', 'data-parsley-validate' => 'true']) }}
            <input type="hidden" name="pageId" value="{{ $data['page']->id }}">
            <div class="form-group">
                <label for="sub-page-title">{{ __('Title') }}</label>
                @include('dashboard::includes.form.input', [
                    'onlyInput' => true,
                    'name' => 'title',
                    'attrs' => [
                        'data-parsley-required' => 'true',
                        'data-parsley-minlength' => 3,
                    ]
                ])
            </div><!-- End ./form-group -->

            <div class="form-group">
                {{ Form::submit(__('Add page'), ['class'=>'btn btn-sm btn-primary no-radius']) }}
            </div><!-- End ./form-group -->
            {{ Form::close() }}

            @if(isset($data['sub-pages']))
                <table class="table table-striped table-bordered sortable"
                       data-save-order="{{ route('text-page.save-order') }}">
                    <thead>
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Created') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['sub-pages'] as $subpage)
                        <tr data-id="{{ $subpage->id }}">
                            <td>{{ $subpage->title }}</td>
                            <td>{{ $subpage->created_at }}</td>
                            <td class="text-center">
                                @include('dashboard::includes.form.table-actions', [
                                    'editAction' => [
                                        'text-page-section.edit',
                                        $subpage->id
                                    ],
                                    'deleteAction' => [
                                        'text-page-section.destroy',
                                        $subpage->id
                                    ],
                                ])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

            @include('dashboard::includes.component.panel-end')


            {{-- PAGE MEDIA --}}
            {{ Form::open(['route' => ['text-page.update', $data['page']->id], 'enctype' => 'multipart/form-data']) }}
            @method('PUT')
            @include('dashboard::includes.page-media')
            {{ Form::close() }}

        </div><!-- End ./col-lg-4 -->

    </div><!-- End ./row -->

@endsection