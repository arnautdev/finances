<x-dashboard-layout>

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $page->intToFloat($data['addedToday']->sum('amount')) }}</h3>

                    <p>{{ __('Spent today') }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">{{ __('More info') }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $data['averagePerDay'] }}</h3>

                    <p>{{ __('Average per day') }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">&nbsp;</a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">

        <div class="col-lg-6 h-100">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Predefined expenses') }}</h3>
                </div><!-- End ./header -->
                <div class="card-body">
                    <div class="row">
                        @if(isset($data['expensesList']))
                            @foreach($data['expensesList'] as $expense)
                                <div class="col-lg-3 col-6 no-padding">
                                    @if(!$expense->isDynamicAmount())
                                        {{ Form::open(['route' => 'add-expense.store']) }}
                                        <input type="hidden" name="userId" value="{{ auth()->id() }}">
                                        <input type="hidden" name="expenseId" value="{{ $expense->id }}">
                                        <input type="hidden" name="categoryId" value="{{ $expense->categoryId }}">
                                        <input type="hidden" name="amount"
                                               value="{{ $page->intToFloat($expense->amount) }}">

                                        <button type="submit" class="btn btn-default h-100 w-100 no-radius">
                                            {{ $expense->title }}<br>
                                            {{ $page->intToFloat($expense->amount) }}
                                        </button>
                                        {{ Form::close() }}
                                    @else
                                        <a href="#set-amount" onclick="showSetAmountModal(this)"
                                           data-url="{{ route('setAmountModal', $expense->id) }}"
                                           class="btn btn-default h-100 w-100 no-radius"
                                        >

                                            {{ $expense->title }}<br>
                                            {{ $page->intToFloat($expense->amount) }}
                                        </a>
                                    @endif
                                </div><!-- End./col-lg -->
                            @endforeach
                        @endif
                    </div><!-- End row -->
                </div><!-- End ./body -->
            </div><!-- End ./card -->

        </div>
        <!-- End ./col-lg-6 -->

        <div class="col-lg-6">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Added today') }}</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-dollar"></i>&nbsp;
                            {{ $page->intToFloat($data['addedToday']->sum('amount')) }}
                        </a>
                    </div>
                </div><!-- End ./header -->

                <div class="card-body">
                    <div class="form-group">
                        {{ Form::open(['route' => 'add-expense.store']) }}
                        <input type="hidden" name="userId" value="{{ auth()->id() }}">
                        <div class="form-group">
                            {{ $form->input([
                                'onlyInput' => true,
                                'name' => 'title',
                                'attrs' => [
                                    'required' => 'required'
                                ]
                            ]) }}
                        </div>

                        <div class="form-group">
                            {{ $form->select([
                                'onlyInput' => true,
                                'emptyOption' => true,
                                'name' => 'categoryId',
                                'options' => $data['categories'],
                                'attrs' => [
                                    'required' => 'required'
                                ]

                            ]) }}
                        </div>

                        <div class="form-group">
                            {{ $form->amount([
                                'onlyInput' => true,
                                'name' => 'amount',
                                'attrs' => [
                                    'required' => 'required'
                                ]
                            ]) }}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-info">{{ __('Add') }}</button>
                        </div>

                        {{ Form::close() }}
                    </div>

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['addedToday'] as $expense)

                            <tr>
                                <td>{{ $expense->getExpense()->title }}</td>
                                <td>{{ $page->intToFloat($expense->amount) }}</td>
                                <td class="text-center">
                                    {{ Form::open(['route' => ['add-expense.destroy', $expense->id]]) }}
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs" title="{{ __('Delete') }}">
                                        <i class="fa fa-trash"></i>&nbsp;{{ __('Delete') }}
                                    </button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- End ./body -->
            </div><!-- End ./card -->
        </div>
        <!-- End ./col-lg-6 -->
    </div>
    <!-- End ./row -->

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        {{ __('To Do List') }}
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list ui-sortable" data-widget="todo-list">

                        @foreach($data['todoList'] as $todoList)
                            <li class="{{ $todoList->isDone() ? 'done' : '' }}">
                                <span class="handle ui-sortable-handle">
                                      <i class="fas fa-ellipsis-v"></i>
                                      <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <!-- checkbox -->
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox"
                                           id="todoCheck{{ $loop->index }}"
                                           data-url="{{ route('todo.markAsDone', $todoList->id) }}"
                                           data-id="{{ $todoList->id }}"
                                           @if($todoList->isDone())
                                           checked="checked"
                                        @endif
                                    >
                                    <label for="todoCheck{{ $loop->index }}" class="markAsDone"></label>
                                </div>
                                <!-- todo text -->
                                <span class="text">{{ $todoList->description }}</span>
                                <!-- Emphasis label -->
                                <small class="badge badge-info">
                                    <i class="far fa-clock"></i> {{ $todoList->created_at }}
                                </small>
                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <i class="fas fa-edit edit-todo-row"
                                       data-url="{{ route('todo.edit', $todoList->id) }}"
                                       data-id="{{ $todoList->id }}"
                                    ></i>
                                    <i class="fas fa-trash destroy-todo-row"
                                       data-url="{{ route('todo.destroy', $todoList->id) }}"
                                    ></i>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ Form::open(['route' => 'todo.store', 'data-parsley-validate' => 'true']) }}

                    <div class="form-group">
                        <textarea type="text"
                                  name="description"
                                  required="required"
                                  class="form-control"
                                  placeholder="{{ __('Task description') }}"
                                  maxlength="500"
                        ></textarea>
                    </div><!-- End ./form-group -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-info">
                            <i class="fas fa-plus"></i> {{ __('Add item') }}
                        </button>
                    </div><!-- End ./form-group -->

                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!-- End ./col-lg-6 -->
    </div>
    <!-- End ./row -->

    @push('scripts')
        <script type="text/javascript">
            function showSetAmountModal(el) {
                var $targetUrl = $(el).data('url');
                $.get($targetUrl, function ($resp) {
                    console.log($resp);
                    $('#set-amount-modal').remove();
                    $('body').append($resp);
                    $('#set-amount-modal').modal();
                });
            }
        </script>
    @endpush

</x-dashboard-layout>
