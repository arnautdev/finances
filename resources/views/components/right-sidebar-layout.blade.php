<div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">

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

            <li class="nav-item has-treeview {{ $isMenuOpen(['expenses-categories', 'expenses']) }}">
                <a href="#"
                   class="nav-link {{ $isActive(['expenses-categories', 'expenses']) }}">

                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        {{ __('Expenses settings') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('expenses-categories.index') }}"
                           class="nav-link {{ $isActive('expenses-categories') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Expenses categories') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('expenses.index') }}"
                           class="nav-link {{ $isActive('expenses') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Expenses settings') }}</p>
                        </a>
                    </li>
                </ul>
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

            <li class="nav-item">
                <a href="{{ route('yearly-preview.index') }}"
                   class="nav-link @if(request()->routeIs('yearly-preview.*')) active @endif">
                    <i class="nav-icon fas fa-align-justify"></i>
                    <p>
                        {{ __('Yearly reports') }}
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('todo.index') }}"
                   class="nav-link @if(request()->routeIs('todo.*')) active @endif">
                    <i class="nav-icon fas fa-align-justify"></i>
                    <p>
                        {{ __('TODO List') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('goal.index') }}"
                   class="nav-link @if(request()->routeIs('goal.*') || request()->routeIs('goal-action.*')) active @endif">
                    <i class="nav-icon fas fa-align-justify"></i>
                    <p>
                        {{ __('My Goals') }}
                    </p>
                </a>
            </li>

        </ul>
    </nav>
</div>
