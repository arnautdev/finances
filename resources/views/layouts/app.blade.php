<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
<div id="app">
    @include('includes.header')
    @include('includes.component.flash')

    <main class="py-4">
        @yield('content')
    </main><!-- End ./content -->
</div><!-- End ./app -->
@include('includes.footer')
</body>
</html>
