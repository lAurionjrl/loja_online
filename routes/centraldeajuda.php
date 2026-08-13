<?php

declare(strict_types=1);

use App\Controllers\Site\CentraldeajudaController;

return [
    [
        'method' => 'GET',
        'path' => '/centraldeajuda',
        'action' => [
          CentraldeajudaController::class,
            'index',
        ],
    ],
    
];
