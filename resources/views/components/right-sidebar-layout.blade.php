<div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link"><!-- active -->
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        {{ __('Dashboard') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link"><!-- active -->
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Administrators') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Users') }}</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="nav-link @if(request()->routeIs('dashboard')) active @endif">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Client dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('expenses-categories.index') }}"
                   class="nav-link @if(request()->routeIs('expenses-categories.*')) active @endif">
                    <i class="nav-icon fas fa-align-justify"></i>
                    <p>
                        {{ __('Expenses categories') }}
                    </p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('expenses.index') }}"
                   class="nav-link @if(request()->routeIs('expenses.*')) active @endif">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        {{ __('Expenses settings') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('monthly-reports.index') }}"
                   class="nav-link @if(request()->routeIs('monthly-reports.*')) active @endif">
                    <i class="nav-icon fas fa-align-justify"></i>
                    <p>
                        {{ __('Monthly reports') }}
                    </p>
                </a>
            </li>

        </ul>
    </nav>
</div>
