<x-dashboard-layout>

    <div class="card card-info card-outline">
        <div class="card-body">
            <form action="" method="get">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="">{{ __('Is done') }}</label>
                            {{ $form->select([
                                'name' => 'isDone',
                                'emptyOption' => true,
                                'onlyInput' => true,
                                'options' => [
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                ]
                            ]) }}
                        </div>
                        <!-- End ./form-group -->
                    </div>
                    <!-- End ./col-lg-3 -->
                </div>
                <!-- End ./row -->

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
                    <th>{{ __('Is done') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>

                <tbody>
                @if(isset($data['goals']))
                    @foreach($data['goals'] as $goal)
                        @php
                            $progressPercent = $goal->getGoalProgressPercent();
                        @endphp
                        <tr>
                            <td>{{ $goal->title }}</td>
                            <td>
                                <div class="progress progress-sm active">
                                    <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                                         aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                         style="width: {{ $progressPercent }}%">
                                        <span class="sr-only">{{ $progressPercent }}% Complete</span>
                                    </div>
                                </div>
                                <small class="">{{ $progressPercent }}% Complete</small>
                            </td>
                            <td>{{ $goal->startDate }}</td>
                            <td>{{ $goal->endDate }}</td>
                            <td>{{ __(ucfirst($goal->isDone)) }}</td>
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
