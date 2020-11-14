<x-dashboard-layout>

    <div class="card card-info card-outline">
        <div class="card-body">
            <form action="" method="get">
                <div class="row">
                    <div class="col-lg-3">
                        <input type="text"
                               name="toDate"
                               class="form-control"
                               id="reservation"
                               @if(request()->exists('toDate'))
                               value="{{ request()->get('toDate') }}"
                               @else
                               value="{{ date('Y-01-01') . ' - ' . date('Y-m-d') }}"
                            @endif
                        />
                    </div>

                    <div class="col-lg-3">
                        {{ $form->select([
                            'name' => 'categoryId',
                            'onlyInput' => true,
                            'emptyOption' => true,
                            'options' => $data['categoriesSelectedOptions']
                        ]) }}
                    </div>
                </div><!-- End ./row -->

                <div class="form-group"></div>
                <button type="submit" class="btn btn-sm btn-info">
                    <i class="fa fa-filter"></i>
                    {{ __('Filter') }}
                </button>
                <a href="{{ url()->current()}}" class="btn btn-sm btn-danger">
                    <i class="fa fa-refresh"></i>&nbsp;
                    {{ __('Refresh') }}
                </a>
            </form>
        </div><!-- End ./body -->
    </div><!-- End ./card -->

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('All expenses for today') }}</h3>
        </div><!-- End ./header -->

        <div class="card-body">

            {{ $data['expenses']->links() }}
            <div class="form-group"></div>
            
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="bg-secondary">{{ __('Expense name') }}</th>
                    <th class="bg-secondary">{{ __('Category') }}</th>
                    <th class="bg-secondary">{{ __('Created') }}</th>
                    <th class="bg-secondary">{{ __('Amount') }}</th>
                </tr>
                </thead>

                <tbody>

                @foreach($data['expenses'] as $expense)
                    <tr>
                        <td>{{ $expense->getExpense()->title }}</td>
                        <td>{{ $expense->getCategory()->title }}</td>
                        <td>{{ $expense->toDate }}</td>
                        <th>{{ $expense->getAmount() }}</th>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="3" class="text-right">{{ __('Total') }}</th>
                    <th>{{ $data['aggregator']->getSumStaticExpenses() }}</th>
                </tr>
                </tbody>
            </table>

            <div class="form-group"></div>
            {{ $data['expenses']->links() }}
        </div><!-- End ./body -->
    </div><!-- End ./card -->

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Static yearly expenses') }}</h3>
        </div><!-- End ./header -->

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="bg-secondary">{{ __('Expense name') }}</th>
                    @foreach($data['aggregator']->months as $month)
                        <th>{{ __($page->getSqlDate($month)->format('M-Y')) }}</th>
                    @endforeach
                    <th>{{ __('Total') }}</th>
                </tr>
                </thead>

                <tbody>

                @foreach($data['aggregator']->getStaticMonthlyExpenses() as $expense)
                    <tr>
                        <th>{{ $expense->title }}</th>

                        @foreach($data['aggregator']->months as $month)
                            <td>{{ $page->intToFloat($expense->amount) }}</td>
                        @endforeach
                        <th>{{ $data['aggregator']->getTotalAmount($expense) }}</th>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="13" class="text-right">{{ __('Total') }}</th>
                    <th>{{ $data['aggregator']->getSumStaticExpenses() }}</th>
                </tr>
                </tbody>
            </table>
        </div><!-- End ./body -->
    </div><!-- End ./card -->

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Current yearly expenses') }}</h3>
        </div><!-- End ./header -->

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="bg-secondary">{{ __('Expense name') }}</th>
                    @foreach($data['aggregator']->months as $month)
                        <th>{{ __($page->getSqlDate($month)->format('M-Y')) }}</th>
                    @endforeach
                    <th>{{ __('Total') }}</th>
                </tr>
                </thead>

                <tbody>

                @foreach($data['aggregator']->getAddedExpensesForCurrentYear() as $expenseTitle => $expenses)
                    <tr>
                        <th>{{ $expenseTitle }}</th>

                        @foreach($expenses as $expense)
                            <td>{{ $page->intToFloat($expense->amount) }}</td>
                        @endforeach
                        <th>{{ $data['aggregator']->getTotalAmount($expenses) }}</th>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="13" class="text-right">{{ __('Total') }}</th>
                    <th>{{ $data['aggregator']->getSumAddedExpenses() }}</th>
                </tr>
                </tbody>
            </table>
        </div><!-- End ./body -->
    </div><!-- End ./card -->

</x-dashboard-layout>
