<x-dashboard-layout>

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Added categories') }}</h3>
        </div><!-- End ./header -->

        <div class="card-body">
            <x-form.index-buttons></x-form.index-buttons>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Created') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data['categories'] as $category)
                    <tr>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <x-table-actions id="{{ $category->id }}"></x-table-actions>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- End ./body -->
    </div><!-- End ./card -->

</x-dashboard-layout>
