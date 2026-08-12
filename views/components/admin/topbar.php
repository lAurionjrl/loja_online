<?php

declare(strict_types=1);

$usuarioAdmin = $usuarioAdmin ?? [];

$nomeUsuario = (string) (
    $usuarioAdmin['nome']
        ?? 'Administrador'
);

?>

<header class="topbar">

    <div class="topbar-left">

        <button
            type="button"
            class="sidebar-toggle"
            data-sidebar-toggle
            aria-label="Abrir menu administrativo"
        >

            <i
                class="fas fa-bars"
                aria-hidden="true"
            ></i>

        </button>

        <div>

            <p class="topbar-label">
                Administração
            </p>

            <h1>Visão Geral</h1>

        </div>

    </div>

    <div class="user-info">

        <div class="user-text">

            <span>Olá,</span>

            <strong>
                <?=
                    htmlspecialchars(
                        $nomeUsuario,
                        ENT_QUOTES,
                        'UTF-8'
                    )
                ?>
            </strong>

        </div>

        <i
            class="fas fa-user-circle"
            aria-hidden="true"
        ></i>

    </div>

</header>
