<?php

declare(strict_types=1);

use App\Controllers\Site\MeuspedidosController;

return [
    [
        'method' => 'GET',
        'path' => '/meuspedidos',
        'action' => [
          MeuspedidosController::class,
            'index',
        ],
    ],
    
];
