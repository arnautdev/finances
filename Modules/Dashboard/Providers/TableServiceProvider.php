<?php

namespace Modules\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class TableServiceProvider extends ServiceProvider
{
    public $app;

    /**
     * TableServiceProvider constructor.
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        $this->app = $app;
    }

    /**
     * Set share view
     */
    public function boot()
    {
        view()->share('table', $this);
    }


    public function start($args = [])
    {
        return view('dashboard::component.table-start', $args);
    }

    public function end($args = [])
    {
        return view('dashboard::component.table-end', $args);
    }
}
