<div class="collapse navbar-collapse pull-left" id="top-navbar">
    <ul class="nav navbar-nav">
        @foreach($dashboard->getTopMenu() as $row)
            @if(isset($row['submenu']))
                @if($dashboard->hasAnyPermission($row))
                    <li class="dropdown {{ $dashboard->isActive($row) }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="{{ $row['icon'] }}"></i>&nbsp;
                            {{ $row['label'] }}
                            @if($row['caret'])
                                <b class="caret"></b>
                            @endif
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @foreach($row['submenu'] as $sRow)
                                @if($dashboard->can($sRow))
                                    <li class="{{ $dashboard->isActive($sRow) }}">
                                        <a href="{{ ($sRow['url'] != '#') ? route($sRow['url']) : '#' }}">
                                            {{ __($sRow['label']) }}
                                        </a>
                                    </li>
                                    @if($sRow['driver'])
                                        <li class="divider"></li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @else
                @if($dashboard->can($row))
                    <li>
                        <a href="{{ ($row['url'] != '#') ? route($row['url']) : '#' }}">
                            <i class="{{$row['icon']}}"></i>&nbsp;{{ __($row['label']) }}
                        </a>
                    </li>
                @endif
            @endif
        @endforeach
    </ul>
</div>