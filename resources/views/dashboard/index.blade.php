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
                <a href="#" class="small-box-footer">
                    (spent amount / days of use the system)
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
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
        <div class="col-lg-6">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Predefined expenses') }}</h3>
                </div><!-- End ./header -->
                <div class="card-body">
                    <div class="row">
                        @if(isset($data['expensesList']))
                            @foreach($data['expensesList'] as $expense)
                                <div class="col-lg-3 no-padding">
                                    {{ Form::open(['route' => 'add-expense.store']) }}
                                    <input type="hidden" name="userId" value="{{ auth()->id() }}">
                                    <input type="hidden" name="expenseId" value="{{ $expense->id }}">
                                    <input type="hidden" name="categoryId" value="{{ $expense->categoryId }}">
                                    <input type="hidden" name="amount" value="{{ $expense->amount }}">

                                    <button type="submit" class="btn btn-default h-100 w-100 no-radius">
                                        {{ $expense->title }}<br>
                                        {{ $page->intToFloat($expense->amount) }}
                                    </button>
                                    {{ Form::close() }}
                                </div><!-- End./col-lg -->
                            @endforeach
                        @endif
                    </div><!-- End row -->
                </div><!-- End ./body -->
            </div><!-- End ./card -->

        </div><!-- End ./col-lg-6 -->


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
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Amount') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['addedToday'] as $expense)
                            <tr>
                                <td>{{ $expense->getExpense()->title }}</td>
                                <td>{{ $page->intToFloat($expense->amount) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- End ./body -->
            </div><!-- End ./card -->
        </div><!-- End ./col-lg-6 -->

    </div><!-- End ./row -->

</x-dashboard-layout>
