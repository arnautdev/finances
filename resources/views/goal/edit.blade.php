<x-dashboard-layout>

    <div class="row">
        <div class="col-lg-7">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        {!! __('Edit goal <b>:name</b>', ['name' => strtoupper($data['goal']->title)]) !!}
                    </h3>
                </div>
                <!-- End ./header -->

                <div class="card-body">
                    <div class="form-horizontal form-bordered">
                        {{ Form::open(['route' => ['goal.update', $data['goal']->id]]) }}
                        @method('PUT')

                        {{ $form->input([
                            'label' => 'Title',
                            'name' => 'title',
                            'model' => 'goal',
                        ]) }}


                        {{ $form->dateRange([
                            'label' => 'Start date',
                            'name' => 'startDate',
                            'model' => 'goal',
                        ]) }}

                        {{ $form->dateRange([
                            'label' => 'End date',
                            'name' => 'endDate',
                            'model' => 'goal',
                        ]) }}

                        <x-form.submit-buttons></x-form.submit-buttons>

                        {{ Form::close() }}
                    </div>
                </div>
                <!-- End ./body -->
            </div>
            <!-- End ./card -->
        </div>
        <!-- End ./col-lg -->

        <div class="col-lg-5">

            <div class="card card-info card-outline">
                <div class="card-header">
                    <div class="card-title">{{ __('Actions') }}</div>
                </div>
                <div class="card-body">
                    @if(!$data['goal']->existsGoalAction())
                        {{ Form::open(['route' => 'goal-action.store', 'data-parsley-validate' => 'true']) }}
                        <input type="hidden" name="goalId" value="{{ $data['goal']->id }}">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="">{{ __('Title') }}</label>
                                        <input type="text" name="title" required="required" class="form-control"/>
                                    </div>
                                    <!-- End ./form-group -->
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="">{{ __('Repeat on week-days') }}</label>
                                        {{ $form->select2([
                                            'name' => 'weekDays[]',
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
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="">{{ __('Add to todo-list') }}</label>
                                        <select name="addToTodoList" id="addToTodoList" class="form-control">
                                            <option value="yes">{{ __('Yes') }}</option>
                                            <option value="no">{{ __('No') }}</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <button type="submit" class="btn btn-info btn-sm btn-block">
                                            <i class="fa fa-save"></i>&nbsp;
                                            {{ __('Save goal action') }}
                                        </button>
                                    </div>
                                    <!-- End ./form-control -->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        {{ Form::close() }}
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Repeat on week days') }}</th>
                            <th>{{ __('Add to todo list') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(isset($data['goalActions']))
                            @foreach($data['goalActions'] as $goalActions)
                                <tr>
                                    <td>{{ $goalActions->title }}</td>
                                    <td>{!! $goalActions->getWeekDaysNamesLabel() !!}</td>
                                    <td>{{ $goalActions->addToTodoList }}</td>
                                    <td>
                                        <x-table-actions destroyAction="goal-action.destroy"
                                                         editAction="goal-action.edit"
                                                         id="{{ $goalActions->id }}"
                                        ></x-table-actions>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div><!-- End ./body -->

            </div>
        </div>
        <!-- End ./col-lg-4 -->
    </div>
    <!-- End ./row -->


</x-dashboard-layout>



