<?php

namespace Modules\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * @var
     */
    protected $app;

    /**
     * @var string
     */
    private $namespace = 'dashboard::includes.form.';

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        view()->share('form', $this);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }


    /**
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        if (!method_exists($this, $name)) {
            throw new \Exception('Error action (' . $name . ') not found in ' . get_class($this));
            return false;
        }


        if (isset($arguments[0])) {
            return $this->$name($arguments[0]);
        }
        return $this->$name();
    }


    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function input($args = [])
    {
        return view($this->namespace . '.input', $args);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function amount($args = [])
    {
        return view($this->namespace . '.amount', $args);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function buttons($args = [])
    {
        return view($this->namespace . '.buttons', $args);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function textarea($args = [])
    {
        return view($this->namespace . '.textarea', $args);
    }


    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function attachments($args = [])
    {
        return view($this->namespace . '.attachments', $args);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function select($args = [])
    {
        return view($this->namespace . '.select', $args);
    }


    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tagIt($args = [])
    {
        return view($this->namespace . '.tagIt', $args);
    }


    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function file($args = [])
    {
        return view($this->namespace . '.file', $args);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function isActive($args = [])
    {
        return view($this->namespace . '.isActive', $args);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tableActions($args = [])
    {
        return view($this->namespace . '.table-actions', $args);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function modal($modalName = 'default', $args = [])
    {
        $args['modalName'] = $modalName;
        return view('dashboard::includes.modals.' . $modalName, $args);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function panelStart($args = [])
    {
        return view('dashboard::includes.component.panel-start', $args);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function panelEnd($args = [])
    {
        return view('dashboard::includes.component.panel-end', $args);
    }
}
