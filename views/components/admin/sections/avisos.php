<?php

declare(strict_types=1);

$avisos = $avisos ?? [];

?>

<section
    class="dashboard-section"
    aria-labelledby="tituloAvisos"
>

    <div class="section-header">

        <div>

            <p class="section-label">
                Atenção
            </p>

            <h2 id="tituloAvisos">
                Avisos administrativos
            </h2>

        </div>

    </div>

    <div class="notices-list">

        <?php if ($avisos === []): ?>

            <div class="notice notice-success">

                <i
                    class="fas fa-circle-check"
                    aria-hidden="true"
                ></i>

                <p>
                    Nenhum aviso importante no momento.
                </p>

            </div>

        <?php endif; ?>

        <?php foreach ($avisos as $aviso): ?>

            <div
                class="notice <?=
                    htmlspecialchars(
                        $aviso['classe'],
                        ENT_QUOTES,
                        'UTF-8'
                    )
                ?>"
            >

                <i
                    class="<?=
                        htmlspecialchars(
                            $aviso['icone'],
                            ENT_QUOTES,
                            'UTF-8'
                        )
                    ?>"
                    aria-hidden="true"
                ></i>

                <p>
                    <?=
                        htmlspecialchars(
                            $aviso['texto'],
                            ENT_QUOTES,
                            'UTF-8'
                        )
                    ?>
                </p>

            </div>

        <?php endforeach; ?>

    </div>

</section>
