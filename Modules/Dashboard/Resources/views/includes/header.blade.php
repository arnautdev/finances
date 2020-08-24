<!-- begin #header -->
<div id="header" class="header {{ config('dashboard.header-class') }}">
    <!-- begin navbar-header -->
    <div class="navbar-header">
        <a href="{{ route('dashboard.home') }}" class="navbar-brand">
            <span class="navbar-logo"></span>
            {{ config('app.name') }}
        </a>
    </div>
    <!-- end navbar-header -->

@include('dashboard::includes.header-mega-menu')

<!-- begin header-nav -->
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <notifications></notifications>
        </li>
        <li class="dropdown navbar-language">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="flag-icon flag-icon-us" title="us"></span>
                <span class="name">{{ strtoupper(app()->getLocale()) }}</span> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu p-b-0">
                <li class="arrow"></li>
                @foreach(config('app.locales') as $locale => $title)
                    <li>
                        <a href="{{ url('/locale/' . $locale) }}">
                            <span class="flag-icon flag-icon-us" title="us"></span>
                            {{ $title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="dropdown navbar-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ auth()->user()->getAvatar() }}"
                     alt="{{ auth()->user()->fullname() }}"
                />
                <span class="d-none d-md-inline">{{ auth()->user()->fullname() }}</span>
                <b class="caret"></b>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('profile.index') }}" class="dropdown-item">{{ __('Edit Profile') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Log Out') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    <!-- end header navigation right -->
</div>
<!-- end #header -->
