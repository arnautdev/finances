@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ __('Create category') }}</h4>
                </div>
                <!-- End ./panel-heading -->
                <div class="panel-body">
                {{ Form::open(['route' => 'category.store', 'data-parsley-validate' => 'true']) }}

                {{ $form->input([
                    'name' => 'title',
                    'label' => 'Title',
                    'required' => true
                ]) }}


                {{ $form->submitButton() }}
                    
                <!-- End ./form-group -->
                    {{ Form::close() }}
                </div>
                <!-- End ./panel-body -->
            </div>
            <!-- End ./panel-inverse -->
        </div>
        <!-- End ./col-lg-6 -->

        <div class="col-lg-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ __('Available categories') }}</h4>
                </div>
                <!-- End ./panel-heading -->
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('# Id') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Created') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['categories'] as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    {{ $form->tableActions([
                                        'id' => $category->id,
                                        'editRoute' => 'category.edit',
                                        'destroyRoute' => 'category.destroy'
                                        ]) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End ./panel-body -->
            </div>
            <!-- End ./panel-inverse -->
        </div>
    </div>
    <!-- End ./row -->
@endsection
