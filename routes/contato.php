<?php

declare(strict_types=1);


use App\Controllers\Site\ContatoController;


return [
    [
        'method' => 'GET',
        'path' => '/contato',
        'action' => [
            ContatoController::class,
            'index',
        ],
    ],
    
];
