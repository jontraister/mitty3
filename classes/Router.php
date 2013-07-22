<?php

/**
 * Routes requests.
 *
 * Routes are configured as preg_match pattern matches mapping to a Controller/method name. Any captured matches are passed to the method. If no matches are defined, the whole match is passed.
 * <br />
 * <br />Example:<br />
 * <code>'#^/?$#'=>'Template/index'</code> maps to <code>TemplateController::index('/')</code>
 */
class Router
{

    protected $config;

    /**
     * Construct from config.
     *
     * @param Config $config object with a 'routes' key holding the route map.
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Maps request to a controller method call and executes it
     *
     * @param $path optional request path, if null defaults to $_SERVER['REDIRECT_URL'] or '/' if the latter is not set.
     */
    public function route($path=null)
    {

        if ($path===null) {
            $path = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '/';
        } else  {
            $path = $_SERVER['REQUEST_URI']=$_SERVER['REDIRECT_URL']=$path;
        }

        $action='Error/show';

        $arguments = array();

        foreach ($this->getRoutes() as $regex => $action) {
            $arguments = array();

            if (!preg_match($regex, $path, $arguments))
                continue;

            if (count($arguments) > 1)
                array_shift($arguments); // leave only captured patterns

            break;

        }

        $callable=$this->getAction($action, compact('path'));

        if (!is_callable($callable))
            throw new Exception("Controller '$class' method '$method' not callable!");

        call_user_func_array($callable, $arguments);
    }

    protected function getAction($action, $request) {
        static $default_method = 'index';

        $stack = explode('/', $action);

        if (count($stack) > 2 || count($stack) < 1)
            throw new Exception("Invalid route target '$action'!");

        if (count($stack) < 2)
            $stack[] = $default_method;

        list($class, $method) = $stack;

        $controller = $this->getController($class, $request);

        return array($controller, $method);

    }

    protected function getController($className, $request)
    {
        static $postfix = 'Controller';

        if (!$className)
            $className = '';

        $class = $className . $postfix;

        return new $class($this->config, $request);
    }

    protected function getRoutes()
    {
        return $this->config->routes;
    }

}

