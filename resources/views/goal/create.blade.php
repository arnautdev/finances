<x-dashboard-layout>
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create goal') }}</h3>
        </div><!-- End ./header -->

        <div class="card-body">
            <div class="form-horizontal form-bordered">
                {{ Form::open(['route' => 'goal.store', 'data-parsley-validate' => 'true']) }}

                {{ $form->input([
                    'label' => 'Title',
                    'name' => 'title',
                    'required' => 'required'
                ]) }}


                {{ $form->dateRange([
                    'label' => 'Start date',
                    'name' => 'startDate',
                    'required' => 'required'
                ]) }}

                {{ $form->dateRange([
                    'label' => 'End date',
                    'name' => 'endDate',
                    'required' => 'required'
                ]) }}

                <x-form.submit-buttons></x-form.submit-buttons>

                {{ Form::close() }}
            </div>
        </div><!-- End ./body -->

    </div><!-- End ./card -->
</x-dashboard-layout>
