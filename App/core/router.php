<?php

namespace App\core;

use App\conf\Routes;
use Exception;

class Router
{
    private $routes;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->routes = Routes::routes();
    }

    /**
     * Обработчик роутов
     * файл конфигурации conf/routes.php
     *
     * @throws Exception
     */
    public function start()
    {
        $uri = trim($_SERVER['REQUEST_URI'], "/");

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $parameters = explode('/', $internalRoute);
                $controllerName = "App\controllers\\" . ucfirst(array_shift($parameters)) . "Controller";
                $actionName = ucfirst(array_shift($parameters));

                if (!$controller = new $controllerName) {
                    throw new Exception("Controller not exists");
                }

                $result = call_user_func_array(array($controller, $actionName), $parameters);
                if ($result != null) {
                    break;
                }
            }
        }

    }
}
