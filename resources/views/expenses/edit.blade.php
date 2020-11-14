<x-dashboard-layout>

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Eidt expense :title', ['title' => $data['expense']->title]) }}</h3>
        </div><!-- End ./header -->

        <div class="card-body">

            <div class="form-horizontal form-bordered">
                {{ Form::open(['route' => ['expenses.update', $data['expense']->id], 'data-parsley-validate' => 'true']) }}
                @method('PUT')
                <x-form.submit-buttons></x-form.submit-buttons>

                {{ $form->checkbox([
                    'name' => 'isAutoAdd',
                    'label' => 'Monthly',
                    'model' => 'expense'
                ]) }}

                {{ $form->input([
                    'name' => 'title',
                    'label' => 'Expense title',
                    'required' => true,
                    'model' => 'expense'
                ]) }}

                {{ $form->select([
                    'name' => 'categoryId',
                    'label' => 'Category',
                    'options' => $data['categories'],
                    'model' => 'expense'
                ]) }}

                {{ $form->select([
                    'name' => 'expenseType',
                    'label' => 'Type',
                    'model' => 'expense',
                    'options' => [
                        'dynamic' => __('Dynamic'),
                        'static' => __('Static'),
                    ]
                ]) }}

                {{ $form->amount([
                    'name' => 'amount',
                    'label' => 'Amount',
                    'required' => true,
                    'model' => 'expense'
                ]) }}

                <x-form.submit-buttons></x-form.submit-buttons>

                {{ Form::close() }}
            </div>

        </div><!-- End ./body -->
    </div><!-- End ./card -->

</x-dashboard-layout>
