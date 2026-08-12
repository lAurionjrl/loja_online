<?php

declare(strict_types=1);

$acoesRapidas = $acoesRapidas ?? [];

?>

<section
    class="dashboard-section"
    aria-labelledby="tituloAcoes"
>

    <div class="section-header">

        <div>

            <p class="section-label">
                Atalhos
            </p>

            <h2 id="tituloAcoes">
                Ações rápidas
            </h2>

        </div>

    </div>

    <div class="quick-actions">

        <?php foreach ($acoesRapidas as $acao): ?>

            <a
                class="quick-action"
                href="<?=
                    htmlspecialchars(
                        BASE_URL
                            . $acao['path'],
                        ENT_QUOTES,
                        'UTF-8'
                    )
                ?>"
            >

                <i
                    class="<?=
                        htmlspecialchars(
                            $acao['icone'],
                            ENT_QUOTES,
                            'UTF-8'
                        )
                    ?>"
                    aria-hidden="true"
                ></i>

                <span>
                    <?=
                        htmlspecialchars(
                            $acao['texto'],
                            ENT_QUOTES,
                            'UTF-8'
                        )
                    ?>
                </span>

            </a>

        <?php endforeach; ?>

    </div>

</section>
