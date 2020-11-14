<x-dashboard-layout>

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
