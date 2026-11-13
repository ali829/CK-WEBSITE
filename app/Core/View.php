<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    private const VIEW_PATH = __DIR__ . '/../Views/pages/';
    private const LAYOUT_PATH = __DIR__ . '/../Views/layouts/';

    public static function render(string $view, array $data = []): void
    {
        $viewFile = self::VIEW_PATH . $view . '.php';

        if (!is_file($viewFile)) {
            http_response_code(404);
            require self::VIEW_PATH . '404.php';
            return;
        }

        extract($data, EXTR_SKIP);

        ob_start();
        require $viewFile;
        $content = ob_get_clean();  

        require self::LAYOUT_PATH . 'main.php';
    }
}
