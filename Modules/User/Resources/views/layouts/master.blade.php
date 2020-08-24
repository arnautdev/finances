<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Module User</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ url('/images/logo/favicon.png') }}">
    {{-- Laravel Mix - CSS File --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('modules/css/dashboard.css') }}">
</head>
<body class="pace-top bg-white">

@include('dashboard::includes.component.page-loader')

@yield('content')

{{-- Laravel Mix - JS File --}}
<script type="text/javascript">
    var $appLocale = '{!! app()->getLocale() !!}';
</script>
<script src="{{ asset('modules/js/dashboard.js') }}"></script>

</body>
</html>
