<?php

session_start();

use Core\Router;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    if (file_exists(base_path("{$class}.php"))) {
        require base_path("{$class}.php");
    }
});

$router = new Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

if ($uri === '/'){
    header('Location: /departments', true, 308);
    exit();
}

$uri = explode('/', rtrim($uri, '/'));
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router->route($uri, $method);


