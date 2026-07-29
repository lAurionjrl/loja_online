<?php

declare(strict_types=1);

require APP_ROOT . '/views/layouts/header.php';

?>

<main class="container py-5">

    <h1 class="mb-4">Dashboard administrativo</h1>

    <div class="row g-4">

        <?php foreach ($indicadores as $nome => $valor): ?>

            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">

                        <h2 class="h6 text-uppercase text-secondary">
                            <?=
                                htmlspecialchars(
                                    ucfirst($nome),
                                    ENT_QUOTES,
                                    'UTF-8'
                                )
                            ?>
                        </h2>

                        <p class="display-5 mb-0">
                            <?= (int) $valor ?>
                        </p>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>

</main>

<?php

require APP_ROOT . '/views/layouts/footer.php';
