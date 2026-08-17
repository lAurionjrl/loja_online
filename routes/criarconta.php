<?php

declare(strict_types=1);

use App\Controllers\Site\CriarcontaController;

return [
    [
        'method' => 'GET',
        'path' => '/criarconta',
        'action' => [
          CriarcontaController::class,
            'index',
        ],
    ],
    
];
