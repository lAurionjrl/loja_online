<?php

declare(strict_types=1);

$tituloPagina = $tituloPagina ?? 'Loja Online';

$baseUrl = defined('BASE_URL')
    ? BASE_URL
    : '';

?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?=
            htmlspecialchars(
                $baseUrl . '/css/style.css',
                ENT_QUOTES,
                'UTF-8'
            )
        ?>"
    >
</head>

<body class="bg-body-tertiary">

    <nav
        class="navbar navbar-expand-lg
               bg-dark navbar-dark"
    >
        <div class="container">

            <a
                class="navbar-brand"
                href="<?=
                    htmlspecialchars(
                        $baseUrl . '/',
                        ENT_QUOTES,
                        'UTF-8'
                    )
                ?>"
            >
                Loja Online
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menuPrincipal"
                aria-controls="menuPrincipal"
                aria-expanded="false"
                aria-label="Abrir menu"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse"
                id="menuPrincipal"
            >
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="<?= $baseUrl ?>/"
                        >
                            Início
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="<?= $baseUrl ?>/produtos"
                        >
                            Produtos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="<?= $baseUrl ?>/contato"
                        >
                            Contato
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="<?= $baseUrl ?>/cliente/perfil"
                        >
                            Meu perfil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="<?= $baseUrl ?>/admin"
                        >
                            Administração
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>
