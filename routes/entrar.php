<?php

declare(strict_types=1);

use App\Controllers\Site\EntrarController;

return [
    [
        'method' => 'GET',
        'path' => '/entrar',
        'action' => [
          EntrarController::class,
            'index',
        ],
    ],
    
];
