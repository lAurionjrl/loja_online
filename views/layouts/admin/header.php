<?php

declare(strict_types=1);

$tituloPagina = $tituloPagina
    ?? 'Painel administrativo';

?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        <?=
            htmlspecialchars(
                $tituloPagina,
                ENT_QUOTES,
                'UTF-8'
            )
        ?>
        — Loja Online
    </title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="<?=
            htmlspecialchars(
                BASE_URL
                    . '/assets/css/admin/dashboard.css',
                ENT_QUOTES,
                'UTF-8'
            )
        ?>"
    >
</head>

<body>

    <div class="admin-layout">
