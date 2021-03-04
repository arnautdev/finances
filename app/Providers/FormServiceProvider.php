<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
    private $namespace = 'components.form.';

    /**
     * @var array
     */
    public $data = [];

    /**
     * FormServiceProvider constructor.
     * @param $app
     */
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

    /**
     *
     */
    public function boot()
    {
        view()->share('form', $this);

        /// set data if exists
        View::composer('*', function ($view) {
            $data = $view->getData();
            if (isset($data['data'])) {
                $this->data = $data;
            }
        });
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function checkbox($args = [])
    {
        $this->data = array_merge($this->data, $args);
        return view($this->namespace . '.checkbox', $this->data);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function input($args = [])
    {
        $this->data = array_merge($this->data, $args);
        return view($this->namespace . '.input', $this->data);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function dateRange($args = [])
    {
        $this->data = array_merge($this->data, $args);
        return view($this->namespace . '.date-range', $this->data);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function select2($args = [])
    {
        $this->data = array_merge($this->data, $args);
        return view($this->namespace . '.select2', $this->data);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function amount($args = [])
    {
        $this->data = array_merge($this->data, $args);
        return view($this->namespace . '.amount', $this->data);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function buttons($args = [])
    {
        $this->data = array_merge($this->data, $args);
        return view($this->namespace . '.buttons', $this->data);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function textarea($args = [])
    {
        $this->data = array_merge($this->data, $args);
        return view($this->namespace . '.textarea', $this->data);
    }


    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function attachments($args = [])
    {
        $this->data = array_merge($this->data, $args);
        return view($this->namespace . '.attachments', $this->data);
    }

    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function select($args = [])
    {
        $this->data = array_merge($this->data, $args);
        return view($this->namespace . '.select', $this->data);
    }


    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tagIt($args = [])
    {
        $this->data = array_merge($this->data, $args);
        return view($this->namespace . '.tagIt', $this->data);
    }


    /**
     * @param array $args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function file($args = [])
    {
        $this->data = array_merge($this->data, $args);
        return view($this->namespace . '.file', $this->data);
    }

    public function custom($args = [])
    {
        $this->data = array_merge($this->data, $args);

        $filePath = $args['filePath'];
        return view('components.' . $filePath, $this->data);
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
