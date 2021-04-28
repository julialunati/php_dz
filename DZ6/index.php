<?php

include_once 'config.php';
require_once 'vendor/autoload.php';

// Routing
$router = new \Project\Core\Router();

$router->add('', ['namespace' => 'Init', 'controller' => 'Init', 'action' => 'index']);
$router->add('authorization', ['namespace' => 'User', 'controller' => 'User', 'action' => 'index']);
$router->add('authenticationerror', ['namespace' => 'User', 'controller' => 'User', 'action' => 'AuthenticationError']);
$router->add('loginerror', ['namespace' => 'User', 'controller' => 'User', 'action' => 'LoginError']);
$router->add('account', ['namespace' => 'Account', 'controller' => 'Account', 'action' => 'index']);
$router->add('admin', ['namespace' => 'Account', 'controller' => 'Account', 'action' => 'admin']);
$router->add('change', ['namespace' => 'Account', 'controller' => 'Account', 'action' => 'change']);

if (!empty($_GET['path'])) {
    $router->dispatch($_GET['path']);
} else {
    $router->dispatch($_SERVER['QUERY_STRING']);
}
