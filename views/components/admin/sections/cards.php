<?php

declare(strict_types=1);

$indicadores = $indicadores ?? [];

?>

<section
    class="dashboard-section"
    aria-labelledby="tituloIndicadores"
>

    <div class="section-header">

        <div>

            <p class="section-label">
                Resumo
            </p>

            <h2 id="tituloIndicadores">
                Indicadores do sistema
            </h2>

        </div>

    </div>

    <div class="dashboard-cards">

        <?php foreach ($indicadores as $indicador): ?>

            <article class="dashboard-card">

                <div class="card-info">

                    <h3>
                        <?=
                            htmlspecialchars(
                                $indicador['titulo'],
                                ENT_QUOTES,
                                'UTF-8'
                            )
                        ?>
                    </h3>

                    <p>
                        <?=
                            htmlspecialchars(
                                (string)
                                    $indicador['valor'],
                                ENT_QUOTES,
                                'UTF-8'
                            )
                        ?>
                    </p>

                </div>

                <div
                    class="card-icon <?=
                        htmlspecialchars(
                            $indicador['classe'],
                            ENT_QUOTES,
                            'UTF-8'
                        )
                    ?>"
                >

                    <i
                        class="<?=
                            htmlspecialchars(
                                $indicador['icone'],
                                ENT_QUOTES,
                                'UTF-8'
                            )
                        ?>"
                        aria-hidden="true"
                    ></i>

                </div>

            </article>

        <?php endforeach; ?>

    </div>

</section>
