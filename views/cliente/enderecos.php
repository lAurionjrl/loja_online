<?php

declare(strict_types=1);

use App\Helpers\View;
?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gerenciamento de endereços do cliente da Loja Online.">
    <title>Meus Endereços | Loja Online</title>
    <base href="/loja_online/public/">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- CSS do projeto -->
    <link rel="stylesheet" href="assets/css/site.css">
</head>

<body class="bg-light">
    <!-- ============================================================
         NAV
    ============================================================= -->
    <?php View::componenteCliente('nav'); ?>

    <!-- ============================================================
         MAIN
    ============================================================= -->
    <main class="py-5">
        <div class="container">
            <!-- ====================================================
                 CABEÇALHO
            ===================================================== -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">
                        <i class="bi bi-geo-alt text-primary me-2"></i>
                        Meus Endereços
                    </h1>
                    <p class="text-muted mb-0">
                        Gerencie os endereços utilizados para entrega dos seus pedidos.
                    </p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovoEndereco">
                    <i class="bi bi-plus-lg me-1"></i>
                    Novo endereço
                </button>
            </div>

            <!-- MENSAGENS DE SUCESSO / ERRO -->
            <?php if (!empty($mensagemSucesso)): ?>
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    <?= htmlspecialchars((string) $mensagemSucesso) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($erros)): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <ul class="mb-0 ps-3">
                        <?php foreach ($erros as $erro): ?>
                            <li><?= htmlspecialchars((string) $erro) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- ====================================================
                 ENDEREÇOS CADASTRADOS (DINÂMICOS)
            ===================================================== -->
            <div class="row g-4">
                <?php if (empty($enderecos)): ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center py-4 mb-0">
                            <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                            Você ainda não possui nenhum endereço cadastrado.
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($enderecos as $endereco): ?>
                        <div class="col-12 col-lg-6">
                            <div class="card <?= !empty($endereco['principal']) ? 'border-primary' : 'border-0' ?> shadow-sm h-100">
                                <div class="card-header bg-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-house-door-fill text-primary me-1"></i>
                                            <strong>
                                                <?= htmlspecialchars($endereco['apelido'] ?? 'Endereço') ?>
                                            </strong>
                                        </div>
                                        <?php if (!empty($endereco['principal'])): ?>
                                            <span class="badge text-bg-primary">
                                                Principal
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h2 class="h6 fw-bold">
                                        <?= htmlspecialchars($endereco['destinatario'] ?? '') ?>
                                    </h2>
                                    <p class="mb-1">
                                        <?= htmlspecialchars($endereco['logradouro'] ?? '') ?>, <?= htmlspecialchars((string) ($endereco['numero'] ?? '')) ?>
                                    </p>
                                    <?php if (!empty($endereco['complemento'])): ?>
                                        <p class="mb-1">
                                            <?= htmlspecialchars($endereco['complemento']) ?>
                                        </p>
                                    <?php endif; ?>
                                    <p class="mb-1">
                                        <?= htmlspecialchars($endereco['bairro'] ?? '') ?>
                                    </p>
                                    <p class="mb-1">
                                        <?= htmlspecialchars($endereco['cidade'] ?? '') ?> - <?= htmlspecialchars($endereco['estado'] ?? '') ?>
                                    </p>
                                    <p class="mb-3">
                                        CEP: <?= htmlspecialchars($endereco['cep'] ?? '') ?>
                                    </p>
                                    <?php if (!empty($endereco['telefone'])): ?>
                                        <div class="border-top pt-3">
                                            <small class="text-muted">
                                                <i class="bi bi-telephone me-1"></i>
                                                <?= htmlspecialchars($endereco['telefone']) ?>
                                            </small>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer bg-white">
                                    <div class="d-flex flex-wrap gap-2">
                                        <!-- Tornar Principal -->
                                        <?php if (empty($endereco['principal'])): ?>
                                            <form action="cliente/enderecos/principal" method="post" class="d-inline">
                                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">
                                                <input type="hidden" name="id_seguro" value="<?= htmlspecialchars($endereco['id_seguro'] ?? '') ?>">
                                                <button type="submit" class="btn btn-outline-success btn-sm">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Tornar principal
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <!-- Excluir -->
                                        <form action="cliente/enderecos/excluir" method="post" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este endereço?');">
                                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">
                                            <input type="hidden" name="id_seguro" value="<?= htmlspecialchars($endereco['id_seguro'] ?? '') ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash me-1"></i>
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- =================================================
                     CARD ADICIONAR ENDEREÇO
                ================================================== -->
                <div class="col-12 col-lg-6">
                    <div class="card border border-2 border-dashed h-100">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center text-center py-5">
                            <i class="bi bi-plus-circle text-primary mb-3" style="font-size: 3rem;"></i>
                            <h2 class="h5 fw-bold">
                                Adicionar outro endereço
                            </h2>
                            <p class="text-muted">
                                Cadastre um novo endereço para receber suas compras.
                            </p>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalNovoEndereco">
                                <i class="bi bi-plus-lg me-1"></i>
                                Cadastrar endereço
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ============================================================
         MODAL - NOVO ENDEREÇO
    ============================================================= -->
    <div class="modal fade" id="modalNovoEndereco" tabindex="-1" aria-labelledby="modalNovoEnderecoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="modalNovoEnderecoLabel">
                        <i class="bi bi-geo-alt text-primary me-2"></i>
                        Novo Endereço
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <!-- FORMULÁRIO ENVIANDO PARA A ROTA DA APLICAÇÃO -->
                <form action="cliente/enderecos/salvar" method="post">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="apelido" class="form-label">Identificação do endereço</label>
                                <input type="text" class="form-control" id="apelido" name="apelido" placeholder="Ex.: Minha Casa, Trabalho">
                            </div>
                            <div class="col-12">
                                <label for="destinatario" class="form-label">Nome do destinatário</label>
                                <input type="text" class="form-control" id="destinatario" name="destinatario" placeholder="Nome completo" required>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" required>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="logradouro" class="form-label">Rua / Avenida</label>
                                <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Nome da rua ou avenida" required>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero" required>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="complemento" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Apartamento, bloco, sala...">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" required>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="">Selecione</option>
                                    <option value="AC">AC</option><option value="AL">AL</option><option value="AP">AP</option>
                                    <option value="AM">AM</option><option value="BA">BA</option><option value="CE">CE</option>
                                    <option value="DF">DF</option><option value="ES">ES</option><option value="GO">GO</option>
                                    <option value="MA">MA</option><option value="MT">MT</option><option value="MS">MS</option>
                                    <option value="MG">MG</option><option value="PA">PA</option><option value="PB">PB</option>
                                    <option value="PR">PR</option><option value="PE">PE</option><option value="PI">PI</option>
                                    <option value="RJ">RJ</option><option value="RN">RN</option><option value="RS">RS</option>
                                    <option value="RO">RO</option><option value="RR">RR</option><option value="SC">SC</option>
                                    <option value="SP">SP</option><option value="SE">SE</option><option value="TO">TO</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="telefone" class="form-label">Telefone para contato</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000">
                            </div>
                            <div class="col-12">
                                <label for="referencia" class="form-label">Ponto de referência</label>
                                <textarea class="form-control" id="referencia" name="referencia" rows="2" placeholder="Ex.: Próximo ao supermercado"></textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="principal" name="principal" value="1">
                                    <label class="form-check-label" for="principal">
                                        Definir como meu endereço principal
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            Salvar endereço
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ============================================================
         FOOTER
    ============================================================= -->
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>