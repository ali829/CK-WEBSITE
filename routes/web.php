<?php

declare(strict_types=1);

return [
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
];
