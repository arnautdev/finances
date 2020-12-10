<x-dashboard-layout>
    <div class="card card-info card-outline">
        <div class="card-body">
            <form action="" method="get">
                <div class="row">
                    {{ $form->custom([
                        'filePath' => 'filters.date-range',
                        'name' => 'created_at'
                    ]) }}
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
            <h3 class="card-title">{{ __('Group by category') }}</h3>
        </div><!-- End ./header -->

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>{{ __('Created At') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Is done') }}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data['todolist'] as $todo)
                    <tr>
                        <td>{{ $todo->created_at }}</td>
                        <td>{{ $todo->description }}</td>
                        <td>{{ ucfirst($todo->isDone) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- End ./body -->
    </div><!-- End ./card -->
</x-dashboard-layout>
