<?php

declare(strict_types=1);

use App\Helpers\View;
?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Configurações de segurança da conta do cliente da Loja Online.">
    <title>Segurança | Loja Online</title>
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
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h3 fw-bold mb-1">
                        <i class="bi bi-shield-lock text-primary me-2"></i>
                        Segurança da Conta
                    </h1>
                    <p class="text-muted mb-0">
                        Gerencie sua senha e acompanhe informações relacionadas à segurança da sua conta.
                    </p>
                </div>
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

            <div class="row g-4">
                <!-- =================================================
                     COLUNA PRINCIPAL
                ================================================== -->
                <div class="col-12 col-lg-8">
                    <!-- =============================================
                         ALTERAR SENHA
                    ============================================== -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h2 class="h5 fw-bold mb-0">
                                <i class="bi bi-key text-primary me-2"></i>
                                Alterar Senha
                            </h2>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">
                                Para manter sua conta protegida, utilize uma senha forte e diferente das utilizadas em outros sites.
                            </p>
                            
                            <!-- FORMULÁRIO ENVIANDO PARA A ROTA OFICIAL -->
                            <form action="cliente/seguranca/senha/atualizar" method="post">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">

                                <!-- SENHA ATUAL -->
                                <div class="mb-3">
                                    <label for="senhaAtual" class="form-label">Senha atual</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" id="senhaAtual" name="senha_atual" placeholder="Digite sua senha atual" autocomplete="current-password" required>
                                    </div>
                                </div>

                                <!-- NOVA SENHA -->
                                <div class="mb-3">
                                    <label for="novaSenha" class="form-label">Nova senha</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" class="form-control" id="novaSenha" name="nova_senha" placeholder="Digite uma nova senha" autocomplete="new-password" required>
                                    </div>
                                    <div class="form-text">
                                        Utilize pelo menos 8 caracteres, incluindo letras e números.
                                    </div>
                                </div>

                                <!-- CONFIRMAR SENHA -->
                                <div class="mb-4">
                                    <label for="confirmarSenha" class="form-label">Confirmar nova senha</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" class="form-control" id="confirmarSenha" name="confirmar_senha" placeholder="Digite novamente a nova senha" autocomplete="new-password" required>
                                    </div>
                                </div>

                                <!-- REQUISITOS -->
                                <div class="alert alert-light border">
                                    <strong>
                                        <i class="bi bi-info-circle text-primary me-1"></i>
                                        Recomendações para sua senha
                                    </strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Utilize pelo menos 8 caracteres.</li>
                                        <li>Combine letras maiúsculas e minúsculas.</li>
                                        <li>Utilize números e caracteres especiais.</li>
                                        <li>Não utilize seu nome ou CPF.</li>
                                    </ul>
                                </div>

                                <!-- BOTÃO -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg me-1"></i>
                                        Alterar senha
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- =============================================
                         SESSÕES / DISPOSITIVOS
                    ============================================== -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h2 class="h5 fw-bold mb-0">
                                <i class="bi bi-laptop text-primary me-2"></i>
                                Dispositivos Conectados
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="bi bi-pc-display text-primary" style="font-size: 2rem;"></i>
                                    </div>
                                    <div>
                                        <h3 class="h6 fw-bold mb-1">Navegador Atual</h3>
                                        <p class="text-muted small mb-1">Sessão Ativa</p>
                                        <span class="badge text-bg-success">Sessão atual</span>
                                    </div>
                                </div>
                                <small class="text-muted">Conectado agora</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- =================================================
                     COLUNA LATERAL
                ================================================== -->
                <aside class="col-12 col-lg-4">
                    <!-- STATUS DA SEGURANÇA -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h2 class="h5 fw-bold mb-0">
                                <i class="bi bi-shield-check text-success me-2"></i>
                                Status da Conta
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                                <div>
                                    <strong class="d-block">Senha configurada</strong>
                                    <small class="text-muted">Sua conta possui senha ativa.</small>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-envelope-check-fill text-success fs-4 me-3"></i>
                                <div>
                                    <strong class="d-block">E-mail vinculado</strong>
                                    <small class="text-muted">
                                        <?= htmlspecialchars($cliente['email'] ?? 'E-mail cadastrado') ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DICAS DE SEGURANÇA -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h2 class="h5 fw-bold mb-0">
                                <i class="bi bi-lightbulb text-warning me-2"></i>
                                Dicas de Segurança
                            </h2>
                        </div>
                        <div class="card-body">
                            <ul class="small text-muted ps-3 mb-0">
                                <li class="mb-2">Nunca compartilhe sua senha com ninguém.</li>
                                <li class="mb-2">Não utilize a mesma senha em vários sites.</li>
                                <li class="mb-2">Sempre encerre a sessão em computadores públicos.</li>
                                <li>Mantenha seu e-mail e telefone atualizados.</li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

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