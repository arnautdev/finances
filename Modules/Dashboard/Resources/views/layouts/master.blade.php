<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('dashboard::includes.head')
    <link rel="stylesheet" href="{{ asset('vendor/leantony/grid/css/grid.css') }}"/>
</head>
<body>
@include('dashboard::includes.component.page-loader')

<div id="page-container" class="{{ $utils->getPageContainerClass() }}">

    @include('dashboard::includes.header')

    @include('dashboard::includes.sidebar')

    {{-- Flash messages --}}
    @include('dashboard::includes.component.flash')

    <div id="content" class="content">
        @include('dashboard::includes.breadcrumbs')

        @yield('content')
    </div>

    @include('dashboard::includes.component.scroll-top-btn')
</div><!-- End ./page-container -->

<script type="text/javascript">
    var $userId = '{!! auth()->user()->id !!}';
    var $appLocale = '{!! app()->getLocale() !!}';
</script>
<script src="{{ asset('modules/js/dashboard.js') }}"></script>
{{--<script src="{{ asset('vendor/leantony/grid/js/grid.js') }}"></script>--}}

@stack('grid_js')
@stack('scripts')

</body>
</html>
