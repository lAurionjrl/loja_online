<?php

declare(strict_types=1);

use App\Controllers\Site\RastrearpedidosController;

return [
    [
        'method' => 'GET',
        'path' => '/rastrearpedidos',
        'action' => [
          RastrearpedidosController::class,
            'index',
        ],
    ],
    
];
