<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch(string $requestPath): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $route = $this->routes[$method][$requestPath] ?? null;

        if ($route === null) {
            http_response_code(404);
            View::render('404');
            return;
        }

        // Validate route configuration
        if (
            !isset($route['controller'], $route['action']) ||
            !is_string($route['controller']) ||
            !is_string($route['action'])
        ) {
            throw new \RuntimeException('Invalid route configuration.');
        }

        $controllerName = 'App\\Controllers\\' . $route['controller'];
        $action = $route['action'];

        if (!class_exists($controllerName)) {
            throw new \RuntimeException("Controller {$controllerName} does not exist.");
        }

        $controller = new $controllerName();

        if (!is_callable([$controller, $action])) {
            throw new \RuntimeException(
                "Action {$action} is not callable on {$controllerName}."
            );
        }

        if (isset($route['page'])) {
            $controller->$action($route['page']);
            return;
        }

        $controller->$action();
    }
}
