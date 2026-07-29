<?php

declare(strict_types=1);

$caminho = parse_url(
    $_SERVER['REQUEST_URI'] ?? '/',
    PHP_URL_PATH
);

$arquivoPublico = __DIR__
    . ($caminho ?: '/');

if (
    PHP_SAPI === 'cli-server'
    && is_file($arquivoPublico)
) {
    return false;
}

require __DIR__ . '/index.php';
