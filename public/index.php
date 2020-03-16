<?php

// PHP version 5.4

// Requiring controllers
require '../App/Controllers/Posts.php';

// Requiring Routing 
require '../Core/Router.php';

$router = new Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
    
// Display the routing table
// echo '<pre>';
//var_dump($router->getRoutes());
// echo htmlspecialchars(print_r($router->getRoutes(), true));
// echo '</pre>';


// Match the requested route
// $url = $_SERVER['QUERY_STRING'];

// if ($router->match($url)) {
//     echo '<pre>';
//     var_dump($router->getParams());
//     echo '</pre>';
// } else {
//     echo "No route found for URL '$url'";
// }

$router->dispatch($_SERVER['QUERY_STRING']);

