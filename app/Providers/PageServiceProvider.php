<?php

namespace App\Providers;

use App\Traits\UtilsAwareTrait;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    use UtilsAwareTrait;

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
        view()->share('page', $this);
    }


    /**
     * Get create route
     * @return string
     */
    public function getCreateRoute()
    {
        $route = Route::currentRouteName();
        $route = explode('.', $route);
        $route[1] = 'create';
        $route = implode('.', $route);
        return route($route);
    }

    /**
     * @return string
     */
    public function getCancelRoute()
    {
        $route = Route::currentRouteName();
        $route = explode('.', $route);
        $route[1] = 'index';
        $route = implode('.', $route);
        return route($route);
    }


    /**
     * @param string $route
     * @return string
     */
    public function getAction($action = 'index', $asString = true)
    {
        $route = Route::currentRouteName();
        $route = explode('.', $route);
        $route[1] = $action;
        $route = implode('.', $route);

        if ($asString) {
            return $route;
        }
        return route($route);
    }


    /**
     * Get page title
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getTitle()
    {
        $route = Route::current();
        $controller = get_class($route->getController());
        $controller = explode('\\', $controller);
        $controllerName = end($controller);

        return __($controllerName);
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getSubTitle()
    {
        $route = Route::current();
        $action = $route->getActionName();
        $action = explode('@', $action);
        $action = end($action);
        $actionName = ucfirst($action);

        return __($actionName);
    }
}
