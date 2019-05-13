<?php

namespace Miciew\Router;

use mysql_xdevapi\Exception;
use Symfony\Component\HttpFoundation\Request;

class Router
{
    protected static $instance = null;

    protected $routes = [];

    protected $request = null;

    protected function __construct()
    {
        $this->loadRoutes();

        $this->request = Request::createFromGlobals();
    }

    /**
     * @return Router
     */
    public static function getInstance()
    {
        if ( is_null(static::$instance) )
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function loadRoutes()
    {
        return $this->routes = require 'routes.php';
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return Request|null
     */
    public function request()
    {
        return $this->request;
    }

    /**
     * @return bool
     */
    public function checkPath()
    {
        return array_key_exists(
            $this->request->getPathInfo(),
            $this->routes
        );
    }

    protected function getRouteByPath($path)
    {
        if( $this->checkPath() )
        {
            return $this->routes[$this->request->getPathInfo()];
        }

        throw new \Exception('404! Page not founded!');
    }

    public function run()
    {
        $routeParameters = $this->getRouteByPath($this->request->getPathInfo());

        $controller = $routeParameters['_controller'];

        if( isset($routeParameters['_methods']) && ! in_array($this->request->getMethod(), $routeParameters['_methods']) )
        {
            throw new \Exception('404!');
        }

        if( is_callable($controller) )
        {
            call_user_func($controller, $this->request);
        }
        else
        {
            $this->runController($controller, $routeParameters['_action']);
        }

    }

    protected function runController( $controller, $method )
    {
        (new $controller)->{$method}($this->request);
    }
}