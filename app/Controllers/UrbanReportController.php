<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Language;
use App\Core\View;
use App\Models\UrbanReport;

final class UrbanReportController
{
    private UrbanReport $urbanReport;

    public function __construct()
    {
        $this->urbanReport = new UrbanReport();
    }

    /**
     * Display the urban report form.
     */
    public function index(): void
    {
        $language = Language::code();

        $categories = $this->urbanReport->getCategories();
        $neighborhoods = $this->urbanReport->getNeighborhoods();

        View::render('services/urban-report', [
            'categories' => $categories,
            'neighborhoods' => $neighborhoods,
            'language' => $language,
            'direction' => Language::direction(),
        ]);
    }
}
