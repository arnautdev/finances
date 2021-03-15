<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
</head>
@php
    $bodyClass = (!empty($boxedLayout)) ? 'boxed-layout ' : '';
    $bodyClass .= (!empty($paceTop)) ? 'pace-top ' : '';
    $bodyClass .= (!empty($bodyExtraClass)) ? $bodyExtraClass . ' ' : '';
@endphp
<body class="{{ $bodyClass }}">
@include('includes.component.page-loader')

<div id="page-container" class="fade">
    @yield('content')
</div>

@include('includes.page-js')
</body>
</html>
