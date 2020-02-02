<?php
/**
 * Created by PhpStorm.
 * User: dmytrobudonnyi
 * Date: 10.10.2018
 * Time: 15:25
 */

//Class Router
class Router
{
    //array of possible routes listed in file routes.php
    private $routes;

    //constructor
    public function __construct()
    {
        //path to routes file
        $routesPath = ROOT . '/config/routes.php';

        //get routes from file
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);

                //define controllers and actions names
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments));

                //define additional parameters
                $parameters = $segments;

                //call needed controller
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;

                //call needed action with parameters ($parameters)
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null) {
                    break;
                }
            }
        }
    }
}
