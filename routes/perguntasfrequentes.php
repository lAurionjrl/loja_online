<?php

declare(strict_types=1);

use App\Controllers\Site\PerguntasfrequentesController;

return [
    [
        'method' => 'GET',
        'path' => '/perguntasfrequentes',
        'action' => [
          PerguntasfrequentesController::class,
            'index',
        ],
    ],
    
];
