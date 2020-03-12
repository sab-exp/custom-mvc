<?php

require '../core/Router.php';

$router =  new Router();


// Add the routes 
// $router->add('', ['controller' => 'Home', 'action' => 'index']);
// $router->add('public/posts', ['controller' => 'Posts', 'action' => 'index']);
// $router->add('public/posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('public/{controller}/{action}',);
$router->add('public/admin/{action}/{controller}',);


// Display the routing table 
echo '<pre>';
// var_dump($router->getRoutes());
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';

// get url from the addressbar
$url = $_SERVER['QUERY_STRING'];

echo "the url is '$url'";

if($router->match($url)){
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
    
}
else {
    echo "No route found for URL '$url'";
}


?>