<?php

include_once 'config.php';
require_once 'vendor/autoload.php';

// Routing
$router = new \Project\Core\Router();

$router->add('', ['namespace' => 'User', 'controller' => 'User', 'action' => 'index']);
$router->add('{controller}/{action}', ['namespace' => 'User']);

if (!empty($_GET['path'])) {
    $router->dispatch($_GET['path']);
} else {
    $router->dispatch($_SERVER['QUERY_STRING']);
}
