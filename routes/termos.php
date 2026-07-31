<?php

declare(strict_types=1);


use App\Controllers\Site\TermosController;


return [
    [
        'method' => 'GET',
        'path' => '/termos',
        'action' => [
            TermosController::class,
            'index',
        ],
    ],
    
];
