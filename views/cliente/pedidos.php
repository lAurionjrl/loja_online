<?php

declare(strict_types=1);

use App\Helpers\View;
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página de pedidos do cliente da Loja Online.">
    <title>Meus Pedidos | Loja Online</title>
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
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h3 fw-bold mb-1">
                        <i class="bi bi-bag-check text-primary me-2"></i>
                        Meus Pedidos
                    </h1>
                    <p class="text-muted mb-0">
                        Consulte seus pedidos e acompanhe o andamento das suas compras.
                    </p>
                </div>
            </div>

            <!-- FILTROS -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <form method="get" action="cliente/pedidos" class="row g-3 align-items-end">
                        <div class="col-12 col-md-5">
                            <label for="buscarPedido" class="form-label">Buscar pedido</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" name="busca" id="buscarPedido" placeholder="Número do pedido" value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="statusPedido" class="form-label">Status</label>
                            <select class="form-select" name="status" id="statusPedido">
                                <option value="">Todos os pedidos</option>
                                <option value="aguardando" <?= ($_GET['status'] ?? '') === 'aguardando' ? 'selected' : '' ?>>Aguardando pagamento</option>
                                <option value="pago" <?= ($_GET['status'] ?? '') === 'pago' ? 'selected' : '' ?>>Pagamento aprovado</option>
                                <option value="preparacao" <?= ($_GET['status'] ?? '') === 'preparacao' ? 'selected' : '' ?>>Em preparação</option>
                                <option value="enviado" <?= ($_GET['status'] ?? '') === 'enviado' ? 'selected' : '' ?>>Enviado</option>
                                <option value="entregue" <?= ($_GET['status'] ?? '') === 'entregue' ? 'selected' : '' ?>>Entregue</option>
                                <option value="cancelado" <?= ($_GET['status'] ?? '') === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-funnel me-1"></i> Filtrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- LISTA DINÂMICA DE PEDIDOS -->
            <?php if (empty($pedidos)): ?>
                <div class="alert alert-info border-0 shadow-sm text-center py-4">
                    <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                    Nenhum pedido foi encontrado.
                </div>
            <?php else: ?>
                <?php foreach ($pedidos as $pedido): ?>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                <div>
                                    <h2 class="h5 fw-bold mb-1">
                                        Pedido #<?= str_pad((string)$pedido['id'], 6, '0', STR_PAD_LEFT) ?>
                                    </h2>
                                    <small class="text-muted">
                                        Realizado em <?= date('d/m/Y \à\s H:i', strtotime($pedido['criado_em'])) ?>
                                    </small>
                                </div>
                                <span class="badge text-bg-<?= $pedido['status_cor'] ?? 'secondary' ?> px-3 py-2">
                                    <?= htmlspecialchars($pedido['status_nome'] ?? $pedido['status']) ?>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-12 col-md-8">
                                    <p class="mb-1"><strong>Itens:</strong> <?= htmlspecialchars((string)($pedido['total_itens'] ?? 1)) ?> item(ns)</p>
                                    <p class="mb-0 text-muted small">Pagamento via: <?= htmlspecialchars($pedido['forma_pagamento'] ?? 'Cartão/PIX') ?></p>
                                </div>
                                <div class="col-12 col-md-4 text-md-end">
                                    <small class="text-muted d-block">Total do pedido</small>
                                    <span class="fs-5 fw-bold text-success me-3">
                                        R$ <?= number_format((float)$pedido['valor_total'], 2, ',', '.') ?>
                                    </span>
                                    <a href="cliente/pedido?id=<?= $pedido['id'] ?>" class="btn btn-outline-primary btn-sm mt-2 mt-md-0">
                                        <i class="bi bi-eye me-1"></i> Ver pedido
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-dark text-white mt-5">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 text-center text-md-start">
                    <strong>Loja Online</strong>
                    <p class="small text-white-50 mb-0">Sua loja online com segurança e praticidade.</p>
                </div>
                <div class="col-12 col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <a href="" class="text-white text-decoration-none me-3">Loja</a>
                    <a href="produtos" class="text-white text-decoration-none me-3">Produtos</a>
                    <a href="cliente/pedidos" class="text-white text-decoration-none">Meus Pedidos</a>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="text-center">
                <small class="text-white-50">&copy; 2026 Loja Online. Todos os direitos reservados.</small>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>