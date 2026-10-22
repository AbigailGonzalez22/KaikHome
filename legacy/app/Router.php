<?php

class Router
{
    /** @var array<string, array{0: class-string, 1: string}> */
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->routes['GET ' . $path] = $handler;
    }

    public function post(string $path, array $handler): void
    {
        $this->routes['POST ' . $path] = $handler;
    }

    public function dispatch(string $method, string $path): void
    {
        $path = rtrim($path, '/');
        $path = $path === '' ? '/' : $path;
        $key = $method . ' ' . $path;

        if (!isset($this->routes[$key])) {
            http_response_code(404);
            require BASE_PATH . '/app/views/pages/404.php';
            return;
        }

        [$controllerClass, $action] = $this->routes[$key];
        (new $controllerClass())->$action();
    }
}
