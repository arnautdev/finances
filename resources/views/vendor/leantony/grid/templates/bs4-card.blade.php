<div class="row laravel-grid" id="{{ $grid->getId() }}">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="pull-right">
                    {!! $grid->renderPaginationInfoAtHeader() !!}
                </div>
                <h4 class="panel-title">{{ $grid->renderTitle() }}</h4>
            </div>
            <div class="panel-body">
                @yield('data')
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-lg-12">
                        {!! $grid->renderPaginationInfoAtFooter() !!}
                        {!! $grid->renderPaginationLinksSection() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>