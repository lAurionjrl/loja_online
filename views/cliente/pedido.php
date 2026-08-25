<?php

declare(strict_types=1);

use App\Helpers\View;
?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Detalhes do pedido do cliente da Loja Online.">
    <title>Pedido #<?= str_pad((string)($pedido['id'] ?? 0), 6, '0', STR_PAD_LEFT) ?> | Loja Online</title>
    <base href="/loja_online/public/">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- CSS do projeto -->
    <link rel="stylesheet" href="assets/css/site.css">
</head>

<body class="bg-light">
    <!-- NAV -->
    <?php View::componenteCliente('nav'); ?>

    <!-- MAIN -->
    <main class="py-5">
        <div class="container">
            <!-- CABEÇALHO -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <a href="cliente/pedidos" class="text-decoration-none">
                        <i class="bi bi-arrow-left me-1"></i> Voltar para meus pedidos
                    </a>
                    <h1 class="h3 fw-bold mt-3 mb-1">
                        Pedido #<?= str_pad((string)($pedido['id'] ?? 0), 6, '0', STR_PAD_LEFT) ?>
                    </h1>
                    <p class="text-muted mb-0">
                        Realizado em <?= isset($pedido['criado_em']) ? date('d/m/Y \à\s H:i', strtotime($pedido['criado_em'])) : '-' ?>
                    </p>
                </div>
                <span class="badge text-bg-<?= $pedido['status_cor'] ?? 'primary' ?> px-3 py-2 fs-6">
                    <?= htmlspecialchars($pedido['status_nome'] ?? $pedido['status'] ?? 'Processando') ?>
                </span>
            </div>

            <div class="row g-4">
                <!-- COLUNA PRINCIPAL -->
                <div class="col-12 col-lg-8">
                    <!-- PRODUTOS -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h2 class="h5 fw-bold mb-0">
                                <i class="bi bi-cart-check text-primary me-2"></i> Produtos do Pedido
                            </h2>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($pedido['itens'])): ?>
                                <?php foreach ($pedido['itens'] as $index => $item): ?>
                                    <div class="row align-items-center g-3">
                                        <div class="col-4 col-md-2">
                                            <img src="<?= htmlspecialchars($item['imagem'] ?? 'assets/img/produtos/sem-foto.jpg') ?>" class="img-fluid rounded border" alt="<?= htmlspecialchars($item['nome']) ?>">
                                        </div>
                                        <div class="col-8 col-md-5">
                                            <h3 class="h6 fw-bold mb-1"><?= htmlspecialchars($item['nome']) ?></h3>
                                            <small class="text-muted">Quantidade: <?= (int)$item['quantidade'] ?></small>
                                        </div>
                                        <div class="col-6 col-md-2">
                                            <small class="text-muted d-block">Preço un.</small>
                                            <strong>R$ <?= number_format((float)$item['preco'], 2, ',', '.') ?></strong>
                                        </div>
                                        <div class="col-6 col-md-3 text-md-end">
                                            <small class="text-muted d-block">Subtotal</small>
                                            <strong>R$ <?= number_format((float)($item['preco'] * $item['quantidade']), 2, ',', '.') ?></strong>
                                        </div>
                                    </div>
                                    <?php if ($index < count($pedido['itens']) - 1): ?><hr><?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted mb-0">Nenhum item encontrado para este pedido.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- ENDEREÇO DE ENTREGA -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h2 class="h5 fw-bold mb-0">
                                <i class="bi bi-geo-alt text-primary me-2"></i> Endereço de Entrega
                            </h2>
                        </div>
                        <div class="card-body">
                            <p class="mb-1"><strong><?= htmlspecialchars($pedido['endereco_rua'] ?? 'Endereço cadastrado') ?>, <?= htmlspecialchars((string)($pedido['endereco_numero'] ?? 'S/N')) ?></strong></p>
                            <p class="mb-1"><?= htmlspecialchars($pedido['endereco_bairro'] ?? '') ?> - <?= htmlspecialchars($pedido['endereco_cidade'] ?? '') ?>/<?= htmlspecialchars($pedido['endereco_uf'] ?? '') ?></p>
                            <p class="mb-0 text-muted">CEP: <?= htmlspecialchars($pedido['endereco_cep'] ?? '-') ?></p>
                        </div>
                    </div>
                </div>

                <!-- COLUNA LATERAL -->
                <aside class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h2 class="h5 fw-bold mb-0">
                                <i class="bi bi-receipt text-primary me-2"></i> Resumo do Pedido
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span>R$ <?= number_format((float)($pedido['subtotal'] ?? $pedido['valor_total'] ?? 0), 2, ',', '.') ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Frete</span>
                                <span>R$ <?= number_format((float)($pedido['frete'] ?? 0), 2, ',', '.') ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>Total</strong>
                                <span class="fs-4 fw-bold text-success">
                                    R$ <?= number_format((float)($pedido['valor_total'] ?? 0), 2, ',', '.') ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-dark text-white mt-5">
        <div class="container py-4">
            <div class="text-center">
                <small class="text-white-50">&copy; 2026 Loja Online. Todos os direitos reservados.</small>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>