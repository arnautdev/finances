<meta charset="utf-8"/>
<title>{{ $utils->getPageTitle() }} | {{ config('app.name') }}</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ url('/images/logo/favicon.png') }}">

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
<link href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('modules/css/dashboard.css') }}"/>
<!-- ================== END BASE CSS STYLE ================== -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('modules/js/pace.min.js') }}"></script>
<!-- ================== END BASE JS ================== -->

@stack('css')