<?php

declare(strict_types=1);

use App\Controllers\Site\TrocaedevoController;

return [
    [
        'method' => 'GET',
        'path' => '/trocaedevo',
        'action' => [
          TrocaedevoController::class,
            'index',
        ],
    ],
    
];
