<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RightSidebarLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.right-sidebar-layout');
    }


    /**
     * Check if is dropdown is open
     * @param array $routes
     * @return string
     */
    public function isMenuOpen(array $routes): string
    {
        $isMenuOpen = '';
        foreach ($routes as $route) {
            if (request()->routeIs($route . '.*')) {
                $isMenuOpen = 'menu-open';
                break;
            }
        }

        return $isMenuOpen;
    }

    /**
     * @param array $routes
     * @return string
     */
    public function isActive($routes): string
    {
        if (!is_array($routes)) {
            $routes = [$routes];
        }
        $isActive = '';
        foreach ($routes as $route) {
            if (request()->routeIs($route . '.*')) {
                $isActive = 'active';
                break;
            }
        }

        return $isActive;
    }
}
