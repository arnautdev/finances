<?php

namespace App\Providers;

use App\Traits\UtilsTrait;
use Illuminate\Support\ServiceProvider;

class UtilsServiceProvider extends ServiceProvider
{
    use UtilsTrait;
    
    /**
     * @var array
     */
    public $pageDivClass = [
        'default' => 'page-container fade page-sidebar-fixed page-header-fixed',
        'product' => 'page-container fade page-sidebar-fixed page-header-fixed', //page-with-two-sidebar show page-sidebar-minified
    ];

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
        view()->share('utils', $this);
    }

    /**
     * Check if action is equal
     * @param null $action
     * @return bool
     */
    public function actionIs($action = null)
    {
        $settings = $this->getPageSettings();
        if ($action == $settings['action']) {
            return true;
        }
        return false;
    }

    /**
     * @param $uri
     */
    public function pageIs($uri)
    {
        $settings = $this->getPageSettings();
        if ($uri == $settings['uri']) {
            return true;
        }
        return false;
    }

    /**
     * Get page container class
     * @return mixed
     */
    public function getPageContainerClass()
    {
        $settings = $this->getPageSettings();
        if (isset($this->pageDivClass[$settings['uri']])) {
            return $this->pageDivClass[$settings['uri']];
        }
        return $this->pageDivClass['default'];
    }


    /**
     * Get page title
     * @return string
     */
    public function getPageTitle()
    {
        $settings = $this->getPageSettings();
        if ($settings['title'] != '') {
            return __(ucfirst($settings['title']));
        }
        return __('Dashboard');
    }
}
