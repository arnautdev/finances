<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('sidebar', $this);
    }

    /**
     * @param array $row
     * @return string
     */
    public function getSidebarRoute(array $row)
    {
        if ($this->hasSubMenu($row)) {
            return 'javascript:;';
        }

        if ($row['route-name'] == 'javascript:;') {
            return $row['route-name'];
        }
        return route($row['route-name']);
    }

    /**
     * Get sub menu class
     * @param $row
     * @return string
     */
    public function getSubMenuClass($row)
    {
        return (isset($row['sub_menu'])) ? 'has-sub' : '';
    }

    /**
     * @param array $row
     * @return bool
     */
    public function hasSubMenu(array $row): bool
    {
        return (isset($row['sub_menu'])) ? true : false;
    }

    /**
     * @param array $row
     * @return bool
     */
    public function isActive(array $row)
    {
//        return 'active';
    }

    /**
     * Get sidebar items
     * @return array
     */
    public function getSidebarRows(): array
    {
        return config('sidebar.menu');
    }
}
