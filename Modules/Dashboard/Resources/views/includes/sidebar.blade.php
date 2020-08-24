<div id="sidebar" class="sidebar {{ config('dashboard.sidebarTransparent') }}">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="{{ auth()->user()->getAvatar() }}"
                             alt="{{ auth()->user()->fullname() }}"
                        />
                    </div>

                    <div class="info">
                        <b class="caret pull-right"></b>
                        {{ auth()->user()->fullname() }}
                        <small>{{ auth()->user()->company }}</small>
                    </div>
                </a>
            </li>
            <li>
                <ul class="nav nav-profile">
                    <li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
                    <li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
                    <li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
                </ul>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            @foreach($dashboard->getSideBar() as $row)
                @if(!is_array($row))
                    <li class="nav-header">{{ __($row) }}</li>
                @elseif(is_array($row))
                    @if(isset($row['submenu']))
                        @if($dashboard->hasAnyPermission($row))
                            <li class="has-sub {{ $dashboard->isActive($row) }}">
                                <a href="javascript:;">
                                    <b class="caret"></b>
                                    <i class="{{ $row['icon'] }}"></i>
                                    <span>{{ __($row['label']) }}</span>
                                </a>
                                <ul class="sub-menu">
                                    @foreach($row['submenu'] as $sRow)
                                        @if($dashboard->can($sRow))
                                            <li class="{{ $dashboard->isActive($sRow) }}">
                                                <a href="{{ ($sRow['url'] != '#') ? route($sRow['url']) : '#' }}">
                                                    {{ __($sRow['label']) }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @else
                        @if($dashboard->can($row))
                            <li class="{{ $dashboard->isActive($row) }}">
                                <a href="{{ ($row['url'] != '#') ? route($row['url']) : '#' }}">
                                    <i class="{{ $row['icon'] }}"></i>
                                    <span>{{ __($row['label']) }}</span>
                                </a>
                            </li>
                        @endif
                    @endif
                @endif
            @endforeach

            <li>
                <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify">
                    <i class="fa fa-angle-double-left"></i>
                </a>
            </li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->

