<x-dashboard-layout>
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create expense') }}</h3>
        </div><!-- End ./header -->

        <div class="card-body">

            <div class="form-horizontal form-bordered">
                {{ Form::open(['route' => 'expenses.store', 'data-parsley-validate' => 'true']) }}

                <x-form.submit-buttons></x-form.submit-buttons>

                {{ $form->checkbox([
                    'name' => 'isAutoAdd',
                    'label' => 'Monthly'
                ]) }}

                {{ $form->input([
                    'name' => 'title',
                    'label' => 'Expense title',
                    'required' => true
                ]) }}

                {{ $form->select([
                    'name' => 'categoryId',
                    'label' => 'Category',
                    'options' => $data['categories']
                ]) }}

                {{ $form->select([
                    'name' => 'expenseType',
                    'label' => 'Type',
                    'options' => [
                        'static' => __('Static'),
                        'dynamic' => __('Dynamic')
                    ]
                ]) }}

                {{ $form->amount([
                    'name' => 'amount',
                    'label' => 'Amount',
                    'required' => true
                ]) }}

                <x-form.submit-buttons></x-form.submit-buttons>

                {{ Form::close() }}
            </div>

        </div><!-- End ./body -->
    </div><!-- End ./card -->
</x-dashboard-layout>
