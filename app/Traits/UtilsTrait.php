<?php


namespace App\Traits;


use Spatie\Permission\Models\Permission;

trait UtilsTrait
{
    /**
     * @param int $size
     * @param null $text
     * @return string
     */
    public function getPlaceholderImage($size = 150, $text = null)
    {
        $url = 'https://via.placeholder.com/' . $size . '/ccc';
        if (!is_null($text)) {
            $url .= '/?text=' . urlencode($text);
        }
        return $url;
    }

    /**
     * @param $productId
     * @return string
     */
    public function getNumber($number, $count = 9)
    {
        return sprintf("1%0{$count}d", $number);
    }

    /**
     * Convert amount to float
     * @param $amount
     * @return string
     */
    public function intToFloat($amount)
    {
        if (strpos($amount, '.') !== false) {
            $amount = $this->floatToInt($amount);
        }
        return number_format(($amount / 100), 2, '.', '');
    }

    /**
     * Convert amount to int
     * @param $amount
     * @return int
     */
    public function floatToInt($amount)
    {
        if (strpos($amount, '.') === false) {
            $amount = number_format(floatval(trim($amount)), 2, '.', '');
        }
        $num = intval(strval(number_format(floatval(trim($amount)), 2, '.', '') * 100));
        return $num;
    }

    /**
     * Get controllers list
     * @return array
     */
    public function getControllersList()
    {
        $skipControllers = config('acl.skipAclControllers');
        $controllers = [];
        foreach (app('routes')->getRoutes() as $route) {
            $action = $route->getAction();
            if (array_key_exists('controller', $action)) {
                $_action = explode('@', $action['controller']);
                $_namespaces_chunks = explode('\\', $_action[0]);

                $controller = end($_namespaces_chunks);
                $uri = explode('.', $route->getAction('as'));
                if (strpos($action['controller'], 'App\Http\Controllers') !== false && !in_array($controller, $skipControllers)) {
                    $controllers[$controller][] = [
                        'controller' => $controller,
                        'action' => end($_action),
                        'namespace' => $action['controller'],
                        'route' => $route,
                        'uri' => $uri[0],
                        'permissionName' => end($_action) . ' ' . $uri[0],
                        'module' => 'App'
                    ];
                } elseif (strpos($action['controller'], 'Modules') !== false && !in_array($controller, $skipControllers)) {
                    $controllers[$controller][] = [
                        'controller' => $controller,
                        'action' => end($_action),
                        'namespace' => $action['controller'],
                        'route' => $route,
                        'uri' => $uri[0],
                        'permissionName' => end($_action) . ' ' . $uri[0],
                        'module' => $_namespaces_chunks[1]
                    ];
                }
            }
        }

        return $controllers;
    }

    /**
     * Get current controller
     * @return mixed
     */
    public function getCurrentController()
    {
        $controller = request()->route()->getAction('as');
        $controller = explode('.', $controller);
        return $controller[0];
    }

    /**
     * Register new permissions
     */
    public function registerNewPermissions()
    {
        foreach ($this->getControllersList() as $controller => $permissions) {
            foreach ($permissions as $permission) {
                foreach (config('auth.guards') as $guardName => $item) {
                    Permission::findOrCreate($permission['permissionName'], $guardName);
                }
            }
        }
    }

    /**
     * @param $content
     * @param $data
     */
    public function dynamicReplace($content, $data)
    {
        return strtr($content, $data);
    }

    /**
     * Get page settings
     * @return array
     */
    public function getPageSettings()
    {
        $args = [];
        if (is_object(request()->route())) {
            $uri = explode('.', request()->route()->getAction('as'));

            $controller = request()->route()->getAction('controller');
            $controller = explode('@', $controller);
            $action = $controller[1];
            $controller = explode("\\", $controller[0]);
            $args = [
                'controller' => end($controller),
                'action' => $action,
                'uri' => $uri[0],
                'pageRoute' => request()->route()->getAction('as'),
                'title' => str_replace('Controller', '', end($controller)),
            ];
        }
        return $args;
    }
}
