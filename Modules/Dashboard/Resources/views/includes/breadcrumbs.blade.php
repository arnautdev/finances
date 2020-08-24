@php
    $settings = $utils->getPageSettings();
@endphp
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    @if(!$utils->pageIs('dashboard'))
        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ __('Dashboard') }}</a></li>
    @endif
    <li class="breadcrumb-item"><a href="#">{{ __(ucfirst($settings['uri'])) }}</a></li>
    <li class="breadcrumb-item active">
        <a href="#">{{ __(ucfirst($settings['action'])) }}</a>
    </li>
</ol>
<!-- end breadcrumb -->

<!-- begin page-header -->
<h1 class="page-header">
    {{ __(ucfirst($settings['uri'])) }}
    <small>{{ __(ucfirst($settings['action'])) }}</small>
</h1>
<!-- end page-header -->