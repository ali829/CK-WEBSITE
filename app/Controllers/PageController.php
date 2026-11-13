<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;

class PageController
{
    public function show(string $page): void
    {
        View::render($page);
    }
}
