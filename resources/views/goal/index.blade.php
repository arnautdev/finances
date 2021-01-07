<x-dashboard-layout>
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Goals') }}</h3>
        </div><!-- End ./header -->

        <div class="card-body table-responsive">
            <x-form.index-buttons></x-form.index-buttons>
            
            <table class="table table-striped table-bordered table-head-fixed text-nowrap">
                <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Progress') }}</th>
                    <th>{{ __('Start Date') }}</th>
                    <th>{{ __('End Date') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>

                <tbody>
                @if(isset($data['goals']))
                    @foreach($data['goals'] as $goal)
                        <tr>
                            <td>{{ $goal->title }}</td>
                            <td>
                                <div class="progress progress-sm active">
                                    <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                                         aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                        <span class="sr-only">20% Complete</span>
                                    </div>
                                </div>
                                <small class="">20% Complete</small>
                            </td>
                            <td>{{ $goal->startDate }}</td>
                            <td>{{ $goal->endDate }}</td>
                            <td>
                                <x-table-actions id="{{ $goal->id }}"></x-table-actions>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div><!-- End ./body -->
    </div><!-- End ./card -->
</x-dashboard-layout>
