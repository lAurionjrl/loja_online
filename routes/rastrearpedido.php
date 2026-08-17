<?php

declare(strict_types=1);

use App\Controllers\Site\RastrearpedidoController;

return [
    [
        'method' => 'GET',
        'path' => '/rastrearpedido',
        'action' => [
          RastrearpedidoController::class,
            'index',
        ],
    ],
    
];
