<?php

class Router {

    // Associative array of routes
    // @var array
    protected $routes = [];

    /**
    * Parameters from the matched route
    * @var array 
    **/
    protected $params = [];

    /* 
    Add a route to the routing table
    @param string $route The route URL
    @param array  $params Parameters (controller, action, etc.)
    */

    public function add ($route, $params = []) {

        // convert the route to a regular expression: escape forward slashes 
        $route = preg_replace('/\//', '\\/', $route);


        // convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Add start and end delimiters, and case insensitive flag 
        $route = '/' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    public function getRoutes() {
        return $this->routes;
    }

    /*
    Match the route to the routes in the routing table, setting the $params
    property if a route is found. 
    
    @param string $url the route URL

    @return boolen true if a match found, false otherwise
    */
    public function match($url) {

        // Match to the fixed url format `/controller/action`
        // $reg_exp = "/public\/(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
        
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {

                foreach($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

            }

            $this->params = $params;
            return true;
        }

        return false;
    }

    /* Get the currently Matched parameters
       @return array
    */
    public function getParams(){
        return $this->params;
    }

}

?>