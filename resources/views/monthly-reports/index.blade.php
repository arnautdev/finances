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
                               value="{{ request()->get('toDate', date('Y-m-01') . ' - ' . date('Y-m-d')) }}"
                        />
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

    <div class="row">
        <div class="col-lg-6">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Group by category') }}</h3>
                </div><!-- End ./header -->

                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Spent amount') }}</th>
                            <th>{{ __('Details') }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($data['categories'] as $category)
                            @php
                                $totalCategoryAmount = $page->intToFloat($category->getMonthlyExpenses(request())->sum('amount'));
                            @endphp
                            @if($totalCategoryAmount > 0)
                                <tr>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $totalCategoryAmount }}</td>
                                    <td>
                                        <a href="{{ route('monthly-reports.category', $category->id) }}"
                                           class="btn btn-xs btn-default">
                                            <i class="fa fa-arrow-right"></i>&nbsp;
                                            {{ __('more info') }}
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        <tr>
                            <td></td>
                            <th>{{ $page->intToFloat($data['totalSpentAmount']) }}</th>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- End ./body -->
            </div><!-- End ./card -->
        </div><!-- End ./col-lg-6 -->

        <div class="col-lg-6">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Expenses this month') }}</h3>
                </div><!-- End ./header -->

                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Amount') }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($data['monthlyExpenses'] as $expense)
                            <tr>
                                <td>{{ $expense->getExpense()->title }}</td>
                                <td>{{ $expense->getCategory()->title }}</td>
                                <td>{{ $page->intToFloat($expense->amount) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <th>{{ $page->intToFloat($data['totalSpentAmount']) }}</th>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- End ./body -->
            </div><!-- End ./card -->
        </div><!-- End ./col-lg-6 -->
    </div><!-- End ./row -->

</x-dashboard-layout>
