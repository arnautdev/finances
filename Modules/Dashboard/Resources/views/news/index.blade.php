@extends('dashboard::layouts.master')

@section('content')
    @include('dashboard::includes.component.panel-start', [
        'title' => 'Added news'
    ])

    @include('dashboard::includes.form.buttons')

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>{{ __('Page title') }}</th>
                <th>{{ __('Modified') }}</th>
                <th>{{ __('Is active') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['news'] as $news)
                <tr>
                    <td>{{ $news->title }}</td>
                    <td>{{ $news->updated_at }}</td>
                    <td>{!! $news->getIsActive() !!}</td>
                    <td class="text-center">
                        @include('dashboard::includes.form.table-actions', [
                            'editAction' => [
                                'news.edit',
                                $news->id
                            ],
                            'deleteAction' => [
                                'news.destroy',
                                $news->id
                            ],
                        ])
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div><!-- End ./table-responsive -->

    @include('dashboard::includes.component.panel-end')
@endsection