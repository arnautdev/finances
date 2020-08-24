<?php

namespace App\Providers;

use App\Traits\UtilsTrait;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    use UtilsTrait;

    /**
     * @var
     */
    public $app;

    /**
     * @var
     */
    public $config;

    /**
     * ColorAdmin constructor.
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->config = config('dashboard');
    }

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
        view()->share('dashboard', $this);
    }


    /**
     * Get sidebar menu
     * @return array|mixed
     */
    public function getSideBar()
    {
        if (isset($this->config['sidebar'])) {
            return $this->config['sidebar'];
        }
        return [];
    }

    /**
     * Get top menu
     * @return array|mixed
     */
    public function getTopMenu()
    {
        if (isset($this->config['top-menu'])) {
            return $this->config['top-menu'];
        }
        return [];
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
        if (isset($row['submenu'])) {
            foreach ($row['submenu'] as $submenu) {
                $permission = explode('.', $submenu['url']);
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
        $permission = explode('.', $row['url'] ?? $row);
        $permission = array_reverse($permission);
        $permission = implode(' ', $permission);

        if (in_array($user->email, config('acl.superAdminEmails'))) {
            return true;
        }
        return $user->can($permission);
    }


    /**
     * @param $row
     */
    public function isActive($row)
    {
        $settings = $this->getPageSettings();
        $currentUri = $settings['uri'];
        if (isset($row['submenu'])) {
            $status = '';
            foreach ($row['submenu'] as $submenu) {
                $controller = explode('.', $submenu['url']);
                if ($controller[0] == $currentUri) {
                    $status = 'active';
                }
            }
            return $status;
        } else {
            $controller = explode('.', $row['url']);
            if ($controller[0] == $currentUri) {
                return 'active';
            }
        }
    }
}
