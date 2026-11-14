<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/Core/Autoloader.php';
\App\Core\Autoloader::register();
\App\Core\Language::initialize($_GET['lang'] ?? 'fr');
require_once dirname(__DIR__) . '/helpers/translation.php';

//? : Application entry point; route dispatch will be connected here.

//* 1. Load environment configuration
require_once dirname(__DIR__) . '/config/environment.php';

//* 2. Get Base Url 
$baseUrl = getenv('BASE_URL') ?: $environment['BASE_URL'] ?? '';

if ($baseUrl === "")
    throw new RuntimeException('BASE_URL is not set in the environment configuration.');

//* 3. Extract the base path from the base URL

$basePath = parse_url($baseUrl, PHP_URL_PATH) ?? '';
$basePath = rtrim($basePath, '/');


// * 4. Get the Request path

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestPath = parse_url($requestUri, PHP_URL_PATH) ?: '/';

//* 5. Remove BASE_PATH from the requested path
if ($basePath !== '') {
    if ($requestPath === $basePath) {
        $requestPath = '/';
    } elseif (str_starts_with($requestPath, $basePath . '/')) {
        $requestPath = substr($requestPath, strlen($basePath));
    } else {
        http_response_code(404);
        exit('Not Found');
    }
}

//* 6. Normalize the route
$requestPath = '/' . trim($requestPath, '/');

if ($requestPath === '') {
    $requestPath = '/';
}


// load routes configuration
$routes = require dirname(__DIR__) . '/routes/web.php';


// Create the router
$router = new \App\Core\Router($routes);

// Dispatch the request
$router->dispatch($requestPath);