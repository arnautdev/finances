@extends('dashboard::layouts.master')

@section('content')

    <!-- begin nav-pills -->
    <ul class="nav nav-pills">
        <li class="nav-items">
            <a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link show active">
                <span class="d-sm-block">{{ __('Product') }}</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link show">
                <span class="d-sm-block d-none">{{ __('Product params') }}</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#nav-pills-tab-3" data-toggle="tab" class="nav-link show">
                <span class="d-sm-block d-none">{{ __('Brands') }}</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#nav-pills-tab-4" data-toggle="tab" class="nav-link show">
                <span class="d-sm-block d-none">{{ __('Products on home page') }}</span>
            </a>
        </li>
    </ul>
    <!-- end nav-pills -->
    <!-- begin tab-content -->
    <div class="tab-content no-padding">
        <!-- begin tab-pane -->
        <div class="tab-pane fade active show" id="nav-pills-tab-1">
            @include('store::catalog.tabs.product')
        </div>
        <!-- end tab-pane -->
        <!-- begin tab-pane -->
        <div class="tab-pane fade" id="nav-pills-tab-2">
            @include('store::catalog.tabs.product-params')
        </div>
        <!-- end tab-pane -->
        <!-- begin tab-pane -->
        <div class="tab-pane fade" id="nav-pills-tab-3">
            <h3 class="m-t-10">Nav Pills Tab 3</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor,
                est diam sagittis orci, a ornare nisi quam elementum tortor.
                Proin interdum ante porta est convallis dapibus dictum in nibh.
                Aenean quis massa congue metus mollis fermentum eget et tellus.
                Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien,
                nec eleifend orci eros id lectus.
            </p>
        </div>
        <!-- end tab-pane -->
        <!-- begin tab-pane -->
        <div class="tab-pane fade" id="nav-pills-tab-4">
            <h3 class="m-t-10">Nav Pills Tab 4</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor,
                est diam sagittis orci, a ornare nisi quam elementum tortor.
                Proin interdum ante porta est convallis dapibus dictum in nibh.
                Aenean quis massa congue metus mollis fermentum eget et tellus.
                Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien,
                nec eleifend orci eros id lectus.
            </p>
        </div>
        <!-- end tab-pane -->
    </div>

@endsection
