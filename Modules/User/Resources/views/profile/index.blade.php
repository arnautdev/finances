@extends('dashboard::layouts.master')

@section('content')
    <div class="profile">
        <div class="profile-header b-b-1">
            <div class="profile-header-cover"></div>
            <div class="profile-header-content">
                <div class="profile-header-img">
                    <img src="{{ auth()->user()->getAvatar() }}"
                         alt="{{ auth()->user()->fullname() }}"
                    />
                </div>
                <div class="profile-header-info">
                    <h4 class="m-t-10 m-b-5">{{ auth()->user()->fullname() }}</h4>
                    <p class="m-b-10">{{ auth()->user()->email }}</p>
                    <p class="m-b-10">{{ auth()->user()->getRole() }}</p>
                </div>
            </div>
            <ul class="profile-header-tab nav nav-tabs">
                <li class="nav-item">
                    <a href="#profile-settings" class="nav-link active" data-toggle="tab">
                        {{ __('My settings') }}
                    </a>
                </li>
                {{--<li class="nav-item">--}}
                {{--<a href="#tab-address" class="nav-link" data-toggle="tab">--}}
                {{--{{ __('Address') }}--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a href="#profile-social-profiles" class="nav-link" data-toggle="tab">--}}
                        {{--{{ __('Social profiles') }}--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                {{--<a href="#profile-subscription" class="nav-link" data-toggle="tab">--}}
                {{--{{ __('Subscription') }}--}}
                {{--</a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
    <div class="profile-content p-0">
        <div class="tab-content p-0">
            <div class="tab-pane fade show active text-left" id="profile-settings">
                @include('user::profile.tabs.profile')
            </div>
            <div class="tab-pane fade in" id="tab-address">
                @include('user::profile.tabs.address')
            </div>
            {{--<div class="tab-pane fade in" id="profile-social-profiles">--}}
            {{--@include('user::profile.tabs.social-profiles')--}}
            {{--</div>--}}
            <div class="tab-pane fade in" id="profile-subscription">
                @include('user::profile.tabs.subscription')
            </div>
        </div>
    </div>
@endsection