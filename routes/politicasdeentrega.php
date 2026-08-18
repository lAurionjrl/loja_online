<?php

declare(strict_types=1);

use App\Controllers\Admin\PoliticasdeentregaController;

return [
    [
        'method' => 'GET',
        'path' => '/politicasdeentrega',
        'action' => [
            PoliticasdeentregaController::class,
            'index',
        ],
    ],
];
