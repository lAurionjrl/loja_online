<?php

declare(strict_types=1);

use App\Controllers\Site\ContaController;

return [
    [
        'method' => 'GET',
        'path' => '/conta',
        'action' => [
            ContaController::class,
            'index',
        ],
    ],
    
];
