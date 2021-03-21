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

                    <div class="form-group">
                        {{ Form::label('title', __('Title')) }}
                        {{ Form::text('title', old('title'), ['class' => 'form-control', 'required' => 'required']) }}
                    </div>
                    <!-- End ./form-group -->


                    <div class="form-group">
                        {{ Form::submit(__('Save category', ['class' => 'btn btn-sm btn-primary'])) }}
                    </div>
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

                </div>
                <!-- End ./panel-body -->
            </div>
            <!-- End ./panel-inverse -->
        </div>
    </div>
    <!-- End ./row -->
@endsection
