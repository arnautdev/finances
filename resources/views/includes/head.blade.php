<meta charset="utf-8"/>
<title>{{ config('app.name', 'Laravel') }}</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
<link href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" rel="stylesheet"/>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- ================== BEGIN BASE JS ================== -->
{{--<script src="/assets/plugins/pace/pace.min.js"></script>--}}
<!-- ================== END BASE JS ================== -->

@stack('css')
