<x-dashboard-layout>

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Dashboard notifications') }}</h3>
        </div><!-- End ./header -->

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Message') }}</th>
                    <th>{{ __('Creation date') }}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data['notifications'] as $notification)
                    <tr>
                        <td>{{ $notification->data['title'] }}</td>
                        <td>{{ $notification->data['message'] }}</td>
                        <td>{{ $notification->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div><!-- End ./body -->
    </div><!-- End ./card -->

</x-dashboard-layout>
