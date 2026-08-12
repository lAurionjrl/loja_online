<?php

declare(strict_types=1);

$itensMenu = $itensMenu ?? [];
$menuAtivo = $menuAtivo ?? 'dashboard';

?>

<aside
    class="sidebar"
    id="sidebarAdmin"
    aria-label="Menu administrativo"
>

    <div class="sidebar-header">

        <i
            class="fas fa-store"
            aria-hidden="true"
        ></i>

        <span>AdminPanel</span>

    </div>

    <nav class="sidebar-navigation">

        <ul class="sidebar-menu">

            <?php foreach ($itensMenu as $item): ?>

                <li
                    class="<?=
                        $menuAtivo === $item['id']
                            ? 'active'
                            : ''
                    ?>"
                >

                    <a
                        href="<?=
                            htmlspecialchars(
                                BASE_URL
                                    . $item['path'],
                                ENT_QUOTES,
                                'UTF-8'
                            )
                        ?>"
                    >

                        <i
                            class="<?=
                                htmlspecialchars(
                                    $item['icone'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                )
                            ?>"
                            aria-hidden="true"
                        ></i>

                        <span>
                            <?=
                                htmlspecialchars(
                                    $item['texto'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                )
                            ?>
                        </span>

                    </a>

                </li>

            <?php endforeach; ?>

            <li class="item-sair">

                <form
                    action="<?=
                        htmlspecialchars(
                            BASE_URL
                                . '/logout-admin',
                            ENT_QUOTES,
                            'UTF-8'
                        )
                    ?>"
                    method="post"
                    class="form-sair"
                >

                    <input
                        type="hidden"
                        name="_token"
                        value="<?=
                            htmlspecialchars(
                                $csrfToken,
                                ENT_QUOTES,
                                'UTF-8'
                            )
                        ?>"
                    >

                    <button
                        type="submit"
                        class="botao-sair"
                    >

                        <i
                            class="fas fa-sign-out-alt"
                            aria-hidden="true"
                        ></i>

                        <span>Sair</span>

                    </button>

                </form>

            </li>

        </ul>

    </nav>

</aside>

<div
    class="sidebar-overlay"
    data-sidebar-overlay
></div>
