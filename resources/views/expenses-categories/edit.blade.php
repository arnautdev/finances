<x-dashboard-layout>
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create category') }}</h3>
        </div><!-- End ./header -->

        <div class="card-body">

            <div class="form-horizontal form-bordered">
                {{ Form::open(['route' => ['expenses-categories.update', $data['category']->id], 'data-parsley-validate' => 'true']) }}
                @method('PUT')
                <x-form.submit-buttons></x-form.submit-buttons>

                {{ $form->input([
                    'name' => 'title',
                    'model' => 'category',
                ]) }}

                {{ Form::close() }}
            </div>

        </div><!-- End ./body -->
    </div><!-- End ./card -->
</x-dashboard-layout>
