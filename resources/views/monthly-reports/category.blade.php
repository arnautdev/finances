<x-dashboard-layout>

    <div class="card card-info card-outline">
        <div class="card-body">
            <form action="" method="get">
                <div class="row">
                    {{ $form->custom([
                        'filePath' => 'filters.date-range'
                    ]) }}
                </div><!-- End ./row -->

                <div class="form-group"></div>
                <button type="submit" class="btn btn-sm btn-info">
                    <i class="fa fa-filter"></i>
                    {{ __('Filter') }}
                </button>
                <a href="{{ url()->current() }}" class="btn btn-sm btn-danger">
                    <i class="fa fa-refresh"></i>&nbsp;
                    {{ __('Refresh') }}
                </a>
            </form>
        </div><!-- End ./body -->
    </div><!-- End ./card -->

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Category: :category', ['category' => $data['category']->title]) }}</h3>
        </div><!-- End ./header -->

        <div class="card-body">

            <div class="form-group">
                <a href="{{ route('monthly-reports.index') }}" class="btn btn-sm btn-default">
                    <i class="fa fa-arrow-left"></i>&nbsp;
                    {{ __('Back to all') }}
                </a>
            </div><!-- End ./form-group -->

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('To date') }}</th>
                    <th>{{ __('Amount') }}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data['categoryExpenses'] as $expense)
                    <tr>
                        <td>{{ $expense->getExpense()->title }}</td>
                        <td>{{ $expense->toDate }}</td>
                        <td>{{ $page->intToFloat($expense->amount) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- End ./body -->
    </div><!-- End ./card -->

</x-dashboard-layout>
