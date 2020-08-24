@extends($grid->getRenderingTemplateToUse())
@section('data')
    <div class="row">
        @if($grid->shouldRenderSearchForm())
            {!! $grid->renderSearchForm() !!}
        @endif

        @if($grid->hasButtons('toolbar'))
            <div class="col-md-{{ $grid->getGridToolbarSize()[1] }}">
                <div class="btn-group pull-right">
                    @foreach($grid->getButtons('toolbar') as $button)
                        {!! $button->render() !!}
                    @endforeach
                </div>
            </div>
        @endif

    </div>
    <form action="{{ $grid->getSearchUrl() }}" method="GET" id="{{ $grid->getFilterFormId() }}"></form>
    <div class="table-responsive grid-wrapper">
        <table class="{{ $grid->getClass() }}">
            <thead class="{{ $grid->getHeaderClass() }}">
            <tr class="filter-header">
                @foreach($columns as $column)

                    @if($loop->first)

                        @if($column->isSortable)
                            <th scope="col"
                                class="{{ is_callable($column->columnClass) ? call_user_func($column->columnClass) : $column->columnClass }}"
                                title="click to sort by {{ $column->key }}">
                                <a data-trigger-pjax="1" class="data-sort"
                                   href="{{ $grid->getSortUrl($column->key, $grid->getSelectedSortDirection()) }}">
                                    @if($column->useRawHtmlForLabel)
                                        {!! $column->name !!}
                                    @else
                                        {{ $column->name }}
                                    @endif
                                </a>
                            </th>
                        @else
                            <th class="{{ is_callable($column->columnClass) ? call_user_func($column->columnClass) : $column->columnClass }}">
                                @if($column->useRawHtmlForLabel)
                                    {!! $column->name !!}
                                @else
                                    {{ $column->name }}
                                @endif
                            </th>
                        @endif
                    @else
                        @if($column->isSortable)
                            <th scope="col" title="click to sort by {{ $column->key }}"
                                class="{{ is_callable($column->columnClass) ? call_user_func($column->columnClass) : $column->columnClass }}">
                                <a data-trigger-pjax="1" class="data-sort"
                                   href="{{ $grid->getSortUrl($column->key, $grid->getSelectedSortDirection()) }}">
                                    @if($column->useRawHtmlForLabel)
                                        {!! $column->name !!}
                                    @else
                                        {{ $column->name }}
                                    @endif
                                </a>
                            </th>
                        @else
                            <th scope="col"
                                class="{{ is_callable($column->columnClass) ? call_user_func($column->columnClass) : $column->columnClass }}">
                                @if($column->useRawHtmlForLabel)
                                    {!! $column->name !!}
                                @else
                                    {{ $column->name }}
                                @endif
                            </th>
                        @endif
                    @endif
                @endforeach
                <th></th>
            </tr>
            @if($grid->shouldRenderGridFilters())
                <tr>
                    {!! $grid->renderGridFilters() !!}
                </tr>
            @endif
            </thead>
            <tbody>
            @if($grid->hasItems())
                @if($grid->warnIfEmpty())
                    <div class="alert alert-warning" role="alert">
                        <strong><i class="fa fa-exclamation-triangle"></i>&nbsp;No data present!.</strong>
                    </div>
                @endif
            @else
                @foreach($grid->getData() as $item)
                    @if($grid->allowsLinkableRows())
                        @php
                            $callback = call_user_func($grid->getLinkableCallback(), $grid->transformName(), $item);
                        @endphp
                        @php
                            $trClassCallback = call_user_func($grid->getRowCssStyle(), $grid->transformName(), $item);
                        @endphp
                        <tr class="{{ trim("linkable " . $trClassCallback) }}" data-url="{{ $callback }}">
                    @else
                        @php
                            $trClassCallback = call_user_func($grid->getRowCssStyle(), $grid->transformName(), $item);
                        @endphp
                        <tr class="{{ $trClassCallback }}">
                            @endif
                            @foreach($columns as $column)
                                @if(is_callable($column->data))
                                    @if($column->useRawFormat)
                                        <td class="{{ $column->rowClass }}">
                                            {!! call_user_func($column->data, $item, $column->key) !!}
                                        </td>
                                    @else
                                        <td class="{{ $column->rowClass }}">
                                            {{ call_user_func($column->data , $item, $column->key) }}
                                        </td>
                                    @endif
                                @else
                                    @if($column->useRawFormat)
                                        <td class="{{ $column->rowClass }}">
                                            {!! $item->{$column->key} !!}
                                        </td>
                                    @else
                                        <td class="{{ $column->rowClass }}">
                                            {{ $item->{$column->key} }}
                                        </td>
                                    @endif
                                @endif
                                @if($loop->last && $grid->hasButtons('rows'))
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @foreach($grid->getButtons('rows') as $button)
                                                @if(call_user_func($button->renderIf, $grid->transformName(), $item))
                                                    {!! $button->render(['gridName' => $grid->transformName(), 'gridItem' => $item]) !!}
                                                @else
                                                    @continue
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        @endforeach
                        @if($grid->shouldShowFooter())
                            <tr class="{{ $grid->getGridFooterClass() }}">
                                @foreach($columns as $column)
                                    @if($column->footer === null)
                                        <td></td>
                                    @else
                                        <td>
                                            <b>{{ call_user_func($column->footer) }}</b>
                                        </td>
                                    @endif
                                    @if($loop->last)
                                        <td></td>
                                    @endif
                                @endforeach
                            </tr>
                        @endif
                    @endif
            </tbody>
        </table>
    </div>
@endsection

@push('grid_js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css" />

    <script type="text/javascript">

        $('a[data-method="DELETE"]').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                type: 'DELETE',
                success: function ($resp) {
                    if ($resp.status === true) {
                        location.reload();
                    }
                }
            });
        });

        $('.date-range').daterangepicker({
            format: 'YYYY-MM-DD',
            minYear: 2019,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    </script>
@endpush
