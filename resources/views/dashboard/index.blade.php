<x-dashboard-layout>

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
                                    <input type="hidden" name="amount" value="{{ $expense->amount }}">

                                    <button type="submit" class="btn btn-default h-100 w-100 no-radius">
                                        {{ $expense->title }}
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

        </div><!-- End ./col-lg-6 -->
    </div><!-- End ./row -->

</x-dashboard-layout>
