<?php

declare(strict_types=1);

$tituloPagina = 'Página não encontrada';

require APP_ROOT . '/views/layouts/header.php';

?>

<main class="container py-5">

    <div class="text-center py-5">

        <p class="display-1 fw-bold text-primary mb-0">
            404
        </p>

        <h1 class="h2">
            Página não encontrada
        </h1>

        <p class="text-secondary">
            O caminho solicitado não está cadastrado no sistema.
        </p>

        <a
            class="btn btn-primary"
            href="<?= BASE_URL ?>/"
        >
            Voltar ao início
        </a>

    </div>

</main>

<?php

require APP_ROOT . '/views/layouts/footer.php';
