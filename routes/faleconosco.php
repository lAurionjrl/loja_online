<?php

declare(strict_types=1);

use App\Controllers\Site\FaleconoscoController;

return [
    [
        'method' => 'GET',
        'path' => '/faleconosco',
        'action' => [
          FaleconoscoController::class,
            'index',
        ],
    ],
    
];
