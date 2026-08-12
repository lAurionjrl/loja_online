<?php

declare(strict_types=1);

use App\Controllers\Site\AjudaController;

return [
    [
        'method' => 'GET',
        'path' => '/ajuda',
        'action' => [
            AjudaController::class,
            'index',
        ],
    ],
    
];
