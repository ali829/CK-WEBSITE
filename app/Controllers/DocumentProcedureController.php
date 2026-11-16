<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Language;
use App\Core\View;
use App\Models\DocumentProcedure;

class DocumentProcedureController
{
    public function index(): void
    {
        $model = new DocumentProcedure();

        $featuredProcedure = $model->getFeatured();

        if ($featuredProcedure !== null) {
            $featuredProcedure['steps'] = $model->getSteps(
                (int) $featuredProcedure['id']
            );
        }

        $procedures = $model->getAllExceptFeatured();

        View::render('services/document-procedures', [
            'featuredProcedure' => $featuredProcedure,
            'procedures' => $procedures,
            'language' => Language::code(),
            'direction' => Language::direction(),
        ]);
    }
}
