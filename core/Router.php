<?php
namespace Viper;

/**
 * Router class
 *
 * load routes, and direct to routes
 *
 */
class Router
{
    private $routes = [
        'GET' => [],
        'POST' => [],
        ];

    /**
     * Loads user's route file
     *
     * @param string $file
     * @return Router instance of Router class
     */
    public static function load(string $file)
    {
        $router = new self();

        require_once $file;

        return $router;
    }

    /**
     * Register controller for a specifed get route
     *
     * @param string $uri
     * @param string $controllerAndAction  HomeControler@action
     */
    public function get(string $uri, string $controllerAndAction)
    {
        $this->routes['GET'][$uri] = $controllerAndAction;
    }

    /**
     * Register controller and method for a specifed post route
     *
     * @param string $uri for example "login"
     * @param string $controllerAndMethod HomeControler@methodName
     */
    public function post(string $uri, string $controllerAndMethod)
    {
        $this->routes['POST'][$uri] = $controllerAndMethod;
    }

    /**
     * Call controller method for defined route
     *
     * @param string $uri
     * @param string $method
     * @return mixed
     */
    public function direct(string $uri, string $method)
    {
        $controllerAndMethod = $this->routes[$method][$uri];

        if (array_key_exists($uri,$this->routes[$method])) {
            //split controller
            $split = explode("@",$controllerAndMethod);
            $controller = $split[0];
            $action = $split[1];

            return $this->callControllerAction($controller,$action);
        }
        else {
            //route for requested uri not found
            Redirect::to('/');
        }
    }

    /**
     * Call specified controller's action
     *
     * @param string $controller
     * @param string $action
     * @return mixed
     */
    private function callControllerAction(string $controller,string $action)
    {
        $controller = "App\\Controllers\\{$controller}";

        $controller = new $controller();
        if (!method_exists($controller,$action)) {
            echo "No controller method defined\n";
        }

        return $controller->$action();
    }
}