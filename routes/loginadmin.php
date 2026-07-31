<?php

declare(strict_types=1);


use App\Controllers\Site\LoginAdminController;


return [
    [
        'method' => 'GET',
        'path' => '/admlogin',
        'action' => [
            LoginAdminController::class,
            'index',
        ],
    ],
    
];
