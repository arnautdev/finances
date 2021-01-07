<x-dashboard-layout>
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Edit goal action') }}</h3>
        </div><!-- End ./header -->

        <div class="card-body">
            <div class="form-horizontal form-bordered">
                {{ Form::open(['route' => ['goal-action.update', $data['goalAction']->id]]) }}
                <input type="hidden" name="goalId" value="{{ $data['goalAction']->goalId }}">
                @method('PUT')

                {{ $form->input([
                    'label' => 'Title',
                    'name' => 'title',
                    'model' => 'goalAction',
                ]) }}

                {{ $form->dateRange([
                    'label' => 'Date time',
                    'name' => 'startDateTime',
                    'model' => 'goalAction',
                    'format' => 'YYYY-MM-DD HH:mm',
                ]) }}

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label text-right">{{ __('Repeat on week-days') }}</label>
                    <div class="col-lg-7">
                        {{ $form->select2([
                        'name' => 'weekDays[]',
                        'model' => 'goalAction',
                        'explode' => true,
                        'options' => [
                                        1 => 'Monday',
                                        2 => 'Tuesday',
                                        3 => 'Wednesday',
                                        4 => 'Thursday',
                                        5 => 'Friday',
                                        6 => 'Saturday',
                                        7 => 'Sunday',
                                    ]
                    ]) }}
                    </div>

                </div>

                {{ $form->select([
                    'label' => 'Add to todo-list',
                    'name' => 'addToTodoList',
                    'model' => 'goalAction',
                    'options' => ['yes' => __('Yes'), 'no' => __('No')],
                ]) }}

                <x-form.submit-buttons
                    cancelUrl="{{ route('goal.edit', $data['goalAction']->id) }}"
                ></x-form.submit-buttons>

                {{ Form::close() }}
            </div>
        </div><!-- End ./body -->

    </div><!-- End ./card -->
</x-dashboard-layout>
