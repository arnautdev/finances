<x-dashboard-layout>

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Added expenses') }}</h3>
        </div><!-- End ./header -->

        <div class="card-body table-responsive">
            <x-form.index-buttons></x-form.index-buttons>

            <table class="table table-striped table-bordered table-head-fixed text-nowrap">
                <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Amount') }}</th>
                    <th>{{ __('Type') }}</th>
                    <th>{{ __('Monthly') }}</th>
                    <th>{{ __('Category') }}</th>
                    <th>{{ __('Created') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>

                <tbody>
                @if(isset($data['expenses']))
                    @foreach($data['expenses'] as $expense)
                        <tr>
                            <td>{{ $expense->title }}</td>
                            <td>{{ $page->intToFloat($expense->amount) }}</td>
                            <td>{{ __(ucfirst($expense->expenseType)) }}</td>
                            <td>{{ __(ucfirst($expense->isAutoAdd)) }}</td>
                            <td>{{ $expense->getCategory()->title }}</td>
                            <td>{{ $expense->created_at }}</td>
                            <td>
                                <x-table-actions id="{{ $expense->id }}"></x-table-actions>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div><!-- End ./body -->
    </div><!-- End ./card -->

</x-dashboard-layout>
