<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Language;
use App\Core\View;
use App\Models\Division;

class DivisionController
{
    public function index(): void
    {
        $model = new Division();

        View::render('administration/divisions', [
            'divisions' => $model->getAllWithServices(),
            'language' => Language::code(),
            'direction' => Language::direction(),
        ]);
    }
}
