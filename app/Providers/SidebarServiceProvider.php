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
     * Check if user have any permissions
     * @param $row
     * @return bool
     */
    public function hasAnyPermission($row)
    {
        $user = auth()->user();
        $subPermissions = [];
        if (isset($row['sub_menu'])) {
            foreach ($row['sub_menu'] as $submenu) {
                $permission = explode('.', $submenu['route-name']);
                $permission = array_reverse($permission);
                $permission = implode(' ', $permission);
                $subPermissions[] = $permission;
            }
        }
        if (in_array($user->email, config('acl.superAdminEmails'))) {
            return true;
        }
        return $user->hasAnyPermission($subPermissions);
    }

    /**
     * @param $row
     */
    public function can($row)
    {
        $user = auth()->user();
        $permission = explode('.', $row['route-name'] ?? $row);
        $permission = array_reverse($permission);
        $permission = implode(' ', $permission);

        if (in_array($user->email, config('acl.superAdminEmails'))) {
            return true;
        }
        return $user->can($permission);
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
        if (!isset($row['route-name'])) {
            return false;
        }

        if (isset($row['sub_menu'])) {
            $isActive = false;
            foreach ($row['sub_menu'] as $subMenu) {
                if (isset($subMenu['route-name'])) {
                    $route = explode('.', $subMenu['route-name']);
                    $route = $route[0] . '.*';
                    if (request()->routeIs($route)) {
                        $isActive = true;
                        break;
                    }
                }
            }
            if ($isActive) {
                return 'active';
            }
        }

        $route = explode('.', $row['route-name']);
        $route = $route[0] . '.*';

        return (request()->routeIs($route)) ? 'active' : '';
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
