@extends('dashboard::layouts.master')

@section('content')

    <div class="form-horizontal form-bordered">
        {!! $form->panelStart([
            'title' => [
                'Edit category: <b>:title</b>',
                ['title' => $data['category']->title]
            ]
        ]) !!}

        {{ Form::open(['route' => ['categories.update', $data['category']->id], 'data-parsley-validate' => true, 'enctype' => 'multipart/form-data']) }}
        @method('PUT')
        {!! $form->buttons() !!}

        @if($data['category']->isChild())
            {!! $form->select([
                'name' => 'parentCategoryId',
                'options' => $data['categories']
            ]) !!}
        @endif

        {!! $form->isActive([
            'label' => 'Is active',
            'name' => 'isActive',
            'data' => $data,
            'model' => 'category',
        ]) !!}

        {!! $form->input([
            'label' => 'Title',
            'name' => 'title',
            'data' => $data,
            'model' => 'category',
            'attrs' => [
                'required' => 'required',
                'data-parsley-minlength' => 3,
                'data-parsley-maxlength' => 500,
            ]
        ]) !!}

        {!! $form->textarea([
            'label' => 'Description',
            'name' => 'description',
            'data' => $data,
            'model' => 'category',
        ]) !!}

        {!! $form->textarea([
            'label' => 'Content',
            'name' => 'content',
            'class' => 'redactor',
            'data' => $data,
            'model' => 'category',
        ]) !!}

        {!! $form->file([
            'label' => 'Product category image',
            'name' => 'attachments',
            'class' => 'btn-block',
            'data' => $data,
            'model' => 'category',
        ]) !!}

        {!! $form->buttons() !!}
        {{ Form::close() }}

        @if(!$data['category']->isChild())
            <div class="form-group row"></div>
            {{ Form::open(['route' => ['categories.store','subcategory' => true], 'data-parsley-validate' => true,]) }}
            <input type="hidden" name="parentCategoryId" value="{{ $data['category']->id }}"/>
            {!! $form->input([
                'label' => 'Title',
                'name' => 'title',
                'attrs' => [
                    'required' => 'required',
                    'data-parsley-minlength' => 3,
                    'data-parsley-maxlength' => 500,
                ]
            ]) !!}

            {!! $form->buttons() !!}
            {{ Form::close() }}

            <div class="form-group row"></div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-right"></label>
                <div class="col-lg-6">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Is Active') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($data['childCategories'] as $childCategory)
                            <tr>
                                <td>{{ $childCategory->title }}</td>
                                <td>{{ $childCategory->isActive }}</td>
                                <td>
                                    {!! $form->tableActions([
                                        'editAction' => ['categories.edit', $childCategory->id],
                                        'deleteAction' => ['categories.destroy', $childCategory->id]
                                    ]) !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- End ./col-lg-6 -->
            </div><!-- End ./form-group -->
        @endif

        {!! $form->panelEnd() !!}
    </div><!-- End ./form-horizontal -->


@endsection