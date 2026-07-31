<?php

declare(strict_types=1);


use App\Controllers\Site\QuemSomosController;


return [
    [
        'method' => 'GET',
        'path' => '/quemsomos',
        'action' => [
            QuemSomosController::class,
            'index',
        ],
    ],
    
];
