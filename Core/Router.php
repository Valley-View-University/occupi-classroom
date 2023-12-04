<?php

namespace Core;

use Exception;

class Router
{
    /**
     * Contains each route uri, controller, and method
     * @var array
     */
    protected array $routes = [];
    // Routes methods definitions with their respective uri, and method
    public function add($method, $uri, $controller)
    {
        $uri = rtrim($uri, '/');
        $this->routes[] = [
            'uri' => explode('/', $uri),
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get($uri, $controller)
    {
        $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        $this->add('PUT', $uri, $controller);
    }

    /**
     * Find corresponding route uri and method and get the appropriate controller for it
     * @param $uri
     * @param $method
     * @return mixed|void
     */
    public function route($uri, $method)
    {
        try {
            foreach ($this->routes as $route) {
                if ($route['method'] === strtoupper($method) && (count($route['uri']) === count($uri))) {
                    $errors = 0;
                    $parameters = [];

                    foreach ($route['uri'] as $key => $value) {
                        if (str_contains($value, ':')) {
                            $parameters[] = $uri[$key];
                        } else if ($value !== $uri[$key]) {
                            $errors++;
                        }
                    }

                    if ($errors === 0) {
                        extract(['uri_param' => $parameters]);
                        return require base_path($route['controller']);
                    }
                }
            }
            abort();

        } catch (Exception) {
            abort();
        }

    }
}
