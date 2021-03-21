@php
    $sidebarClass = (!empty($sidebarTransparent)) ? 'sidebar-transparent' : '';
@endphp
<!-- begin #sidebar -->
<div id="sidebar" class="sidebar {{ $sidebarClass }}">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="/assets/img/user/user-13.jpg" alt=""/>
                    </div>
                    <div class="info">
                        <b class="caret pull-right"></b>
                        Sean Ngu
                        <small>Front end developer</small>
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
            <li class="nav-header">Navigation</li>

            @foreach($sidebar->getSidebarRows() as $row)
                <li class="{{ $sidebar->getSubMenuClass($row) }} {{ $sidebar->isActive($row) }}">
                    <a href="{{ $sidebar->getSidebarRoute($row) }}">
                        @if(isset($row['caret']) && $row['caret'] == true)
                            <b class="caret"></b>
                        @endif
                        <i class="{{ $row['icon'] }}"></i>
                        <span>{{ __($row['title']) }}</span>
                    </a>
                    @if($sidebar->hasSubMenu($row))
                        <ul class="sub-menu">
                            @foreach($row['sub_menu'] as $subMenu)
                                <li class="{{ $sidebar->isActive($subMenu) }}">
                                    <a href="{{ $sidebar->getSidebarRoute($subMenu) }}">{{ __($subMenu['title']) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endIf
                </li>
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

