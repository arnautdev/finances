<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
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
        view()->share('page', $this);
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
