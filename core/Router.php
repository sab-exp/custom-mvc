<?php

class Router {

    /* Associative array of routes (the routing table)
     *  @var array
     */
    protected $routes = [];

    /* Parameters from the matched route
     *  @var array
     */
    protected $params = [];

    /**
     * Add a route to the routing table
     *
     * @param string $route  The route URL
     * @param array  $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function add($route, $params = []) {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        //Convert variables with id {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * Get all the routes from the routing table
     *
     * @return array
     */
    public function getRoutes() {
        return $this->routes;
    }

    /**
     * Match the route to the routes in the routing table, setting the $params
     * property if a route is found.
     *
     * @param string $url The route URL
     *
     * @return boolean  true if a match found, false otherwise
     */
    public function match($url) {

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {

                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    // dispatching the route from the routing table
    public function dispatch ($url) {
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToSudlyCaps($controller);

            if (class_exists($controller)) {

                $controller_object = new $controller();

                $action = $this->params['action'];
                $action = $this->convertToCamelCase['action'];

                if (is_callable([$controller_object, $action])) {
                    $controller_object->$action();
                }
                else {
                    echo "Method $action (in controller $controller) not found";
                }
            }
            else {
                echo "Controller class $controller not found";
            }
        }
        else {
            echo "No route matched";
        }
    }

    /* 
    convert strings with hyphens to StudlyCaps.
    e.g. post-authors => PostAuthors 
    */
    public function convertToStudlyCaps($string) {
        return str_replace('', ucwords(str_replace('-', ' ', $string)));
    }

    /* 
    convert strings with hyphens to to camelCase.
    e.g. add-new => addNew 
    */
    public function convertToCamelCase($string) {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /* Get the currently Matched parameters
       @return array
    */
    public function getParams() {
        return $this->params;
    }
}
