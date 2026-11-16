<?php

declare(strict_types=1);

return [
    'GET' => [
        // Homepage
        '/' => [
            'controller' => 'HomeController',
            'action' => 'index',
        ],

        // Kénitra
        '/kenitra/presentation' => [
            'controller' => 'PageController',
            'action' => 'show',
            'page' => 'kenitra/presentation',
        ],

        '/kenitra/history' => [
            'controller' => 'PageController',
            'action' => 'show',
            'page' => 'kenitra/history',
        ],

        '/kenitra/monographie' => [
            'controller' => 'PageController',
            'action' => 'show',
            'page' => 'kenitra/monographie',
        ],

        '/kenitra/map' => [
            'controller' => 'PageController',
            'action' => 'show',
            'page' => 'kenitra/map',
        ],

        '/kenitra/gallery' => [
            'controller' => 'PageController',
            'action' => 'show',
            'page' => 'kenitra/gallery',
        ],

        // News
        '/actualites' => [
            'controller' => 'PageController',
            'action' => 'show',
            'page' => 'actualites/index',
        ],
        '/actualites/index' => [
            'controller' => 'PageController',
            'action' => 'show',
            'page' => 'actualites/index',
        ],

        // Municipal council
        '/conseil/membres' => [
            'controller' => 'PageController',
            'action' => 'show',
            'page' => 'conseil/membres',
        ],
        '/conseil/mot-du-president' => [
            'controller' => 'PageController',
            'action' => 'show',
            'page' => 'conseil/mot-du-president',
        ],
        '/conseil/bureau' => [
            'controller' => 'PageController',
            'action' => 'show',
            'page' => 'conseil/bureau',
        ],

        // Contact
        '/contact' => [
            'controller' => 'PageController',
            'action' => 'show',
            'page' => 'contact',
        ],

        // Urban problem report
        '/services/urban-report' => [
            'controller' => 'UrbanReportController',
            'action' => 'index',
        ],
        '/services/urban-report/tracking' => [
            'controller' => 'UrbanReportController',
            'action' => 'tracking',
        ],
        '/services/document-procedures' => [
            'controller' => 'DocumentProcedureController',
            'action' => 'index',
        ],
        // the divisions
        '/administration/divisions' => [
            'controller' => 'DivisionController',
            'action' => 'index',
        ],
    ],

    'POST' => [
        '/services/urban-report' => [
            'controller' => 'UrbanReportController',
            'action' => 'store',
        ],
        '/services/urban-report/tracking' => [
            'controller' => 'UrbanReportController',
            'action' => 'searchTracking',
        ],
    ],
];
