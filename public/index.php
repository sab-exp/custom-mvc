<?php

// PHP version 5.4


// Requiring all the classes from Vendor and my classes
require_once dirname(__DIR__) . '/vendor/autoload.php';


$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
    
$router->dispatch($_SERVER['QUERY_STRING']);

