<?php

declare(strict_types=1);

namespace App\Core;

class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register(function (string $class): void {

            $prefix = 'App\\';

            // Ignore classes outside our application namespace
            if (!str_starts_with($class, $prefix)) {
                return;
            }

            // Remove the namespace prefix
            $relativeClass = substr($class, strlen($prefix));

            // Convert namespace separators into directory separators
            $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass);

            // Build the absolute file path
            $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . $classPath . '.php';

            if (is_file($file)) {
                require_once $file;
            }
        });
    }
}
