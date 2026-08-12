<?php

declare(strict_types=1);

use App\Helpers\View;

require APP_ROOT
    . '/views/layouts/admin/header.php';

View::componente(
    'admin/sidebar',
    [
        'itensMenu' =>
            $itensMenu,

        'menuAtivo' =>
            $menuAtivo,

        'csrfToken' =>
            $csrfToken,
    ]
);

?>

```
<base href="/loja_online/public/">[cite: 1]

<link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">[cite: 1]

<!-- Dependências Externas (Bootstrap 5.3.8 e Bootstrap Icons)[cite: 1] -->
<link rel="stylesheet" href="[https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css](https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css)">[cite: 1]
<link rel="stylesheet" href="[https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css](https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css)">[cite: 1]

<!-- Estilos Personalizados[cite: 1] -->
<style>
    :root {
        --sidebar-width: 260px;
        --sidebar-bg: #1e293b;
        --sidebar-hover: #334155;
        --sidebar-active: #0d6efd;
        --main-bg: #f8fafc;
    }

    body {
        background-color: var(--main-bg);
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    /* Layout Desktop[cite: 1] */
    @media (min-width: 992px) {
        .sidebar-desktop {
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            background-color: var(--sidebar-bg);
            overflow-y: auto;
        }
        .main-wrapper {
            margin-left: var(--sidebar-width);
        }
    }

    /* Menu Lateral[cite: 1] */
    .sidebar-bg {
        background-color: var(--sidebar-bg);
    }

    .nav-link-admin {
        color: #94a3b8;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }

    .nav-link-admin:hover,
    .nav-link-admin:focus {
        color: #ffffff;
        background-color: var(--sidebar-hover);
    }

    .nav-link-admin.active {
        color: #ffffff;
        background-color: var(--sidebar-active);
    }

    .sidebar-heading {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        margin-top: 1.25rem;
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    /* Cards & Animações Hover[cite: 1] */
    .card-stat {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-stat:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
    }

    .card-quick-access {
        transition: all 0.2s ease;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .card-quick-access:hover {
        transform: translateY(-2px);
        border-color: #0d6efd !important;
        box-shadow: 0 0.25rem 0.75rem rgba(13, 110, 253, 0.15) !important;
    }

    /* Componentes Complementares[cite: 1] */
    .badge-status {
        font-weight: 500;
    }

    .top-navbar {
        z-index: 999;
    }
</style>

```

```
<!-- 
    NOTA DE SEGURANÇA E ARQUITETURA DE CÓDIGO[cite: 1]:
    1. Esta página deve ser convertida posteriormente para 'dashboard.php'.[cite: 1]
    2. O administrador deve passar por verificação de sessão/autenticação no arquivo PHP correspondente antes de carregar o HTML.[cite: 1]
    3. Todos os contadores, tabelas e dados operacionais exibidos aqui devem ser alimentados via banco de dados em produção.[cite: 1]
    4. O acesso deve ser sempre feito através de rotas gerenciadas por 'routes/admin.php' e nunca acessando diretamente os arquivos em 'views/admin/'.[cite: 1]
-->

<!-- 1. Menu Lateral (Desktop)[cite: 1] -->
<aside class="sidebar-desktop d-none d-lg-flex flex-column text-white p-3" aria-label="Menu de Navegação Principal">
    <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom border-secondary">
        <i class="bi bi-shop fs-3 text-primary" aria-hidden="true"></i>
        <div>
            <h2 class="h6 mb-0 fw-bold text-white">Loja Online</h2>[cite: 1]
            <small class="text-secondary d-block fs-7">Painel administrativo</small>[cite: 1]
        </div>
    </div>

    <nav class="flex-grow-1">
        <div class="sidebar-heading">Visão geral</div>[cite: 1]
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a href="admin" class="nav-link-admin active">[cite: 1]
                    <i class="bi bi-speedometer2" aria-hidden="true"></i> Dashboard[cite: 1]
                </a>
            </li>
            <li class="nav-item">
                <a href="admin/relatorios" class="nav-link-admin">[cite: 1]
                    <i class="bi bi-bar-chart" aria-hidden="true"></i> Relatórios[cite: 1]
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">Cadastros</div>[cite: 1]
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a href="admin/produtos" class="nav-link-admin">[cite: 1]
                    <i class="bi bi-box-seam" aria-hidden="true"></i> Produtos[cite: 1]
                </a>
            </li>
            <li class="nav-item">
                <a href="admin/categorias" class="nav-link-admin">[cite: 1]
                    <i class="bi bi-tags" aria-hidden="true"></i> Categorias[cite: 1]
                </a>
            </li>
            <li class="nav-item">
                <a href="admin/clientes" class="nav-link-admin">[cite: 1]
                    <i class="bi bi-people" aria-hidden="true"></i> Clientes[cite: 1]
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">Vendas</div>[cite: 1]
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a href="admin/pedidos" class="nav-link-admin">[cite: 1]
                    <i class="bi bi-cart-check" aria-hidden="true"></i> Pedidos[cite: 1]
                </a>
            </li>
            <li class="nav-item">
                <a href="admin/pagamentos" class="nav-link-admin">[cite: 1]
                    <i class="bi bi-credit-card" aria-hidden="true"></i> Pagamentos[cite: 1]
                </a>
            </li>
            <li class="nav-item">
                <a href="admin/carrinhos" class="nav-link-admin">[cite: 1]
                    <i class="bi bi-cart3" aria-hidden="true"></i> Carrinhos ativos[cite: 1]
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">Controle</div>[cite: 1]
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a href="admin/estoque" class="nav-link-admin">[cite: 1]
                    <i class="bi bi-boxes" aria-hidden="true"></i> Estoque[cite: 1]
                </a>
            </li>
            <li class="nav-item">
                <a href="admin/notificacoes" class="nav-link-admin">[cite: 1]
                    <i class="bi bi-bell" aria-hidden="true"></i> Notificações[cite: 1]
                </a>
            </li>
            <li class="nav-item">
                <a href="admin/contatos" class="nav-link-admin">[cite: 1]
                    <i class="bi bi-envelope" aria-hidden="true"></i> Contatos[cite: 1]
                </a>
            </li>
            <li class="nav-item">
                <a href="admin/configuracoes" class="nav-link-admin">[cite: 1]
                    <i class="bi bi-gear" aria-hidden="true"></i> Configurações[cite: 1]
                </a>
            </li>
        </ul>
    </nav>

    <div class="pt-3 border-top border-secondary mt-3 d-flex flex-column gap-2">
        <a href="" target="_blank" class="btn btn-outline-light btn-sm w-100 text-start d-flex align-items-center gap-2">[cite: 1]
            <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Visualizar loja[cite: 1]
        </a>
        
        <!-- Formulário seguro para Logout do sistema sem expor CSRF diretamente no HTML estático[cite: 1] -->
        <!-- NOTA: Incluir campo hidden para token CSRF dinâmico quando convertido para PHP[cite: 1] -->
        <form action="admin/sair" method="post" class="w-100">[cite: 1]
            <!-- <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"> -->
            <button type="submit" class="btn btn-danger btn-sm w-100 text-start d-flex align-items-center gap-2">[cite: 1]
                <i class="bi bi-power" aria-hidden="true"></i> Sair do sistema[cite: 1]
            </button>
        </form>
    </div>
</aside>

<!-- Menu Lateral Offcanvas (Mobile e Tablet)[cite: 1] -->
<div class="offcanvas offcanvas-start sidebar-bg text-white d-lg-none" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
    <div class="offcanvas-header border-bottom border-secondary">
        <div class="d-flex align-items-center gap-2" id="offcanvasSidebarLabel">
            <i class="bi bi-shop fs-3 text-primary" aria-hidden="true"></i>
            <div>
                <h5 class="offcanvas-title fw-bold text-white mb-0">Loja Online</h5>
                <small class="text-secondary d-block fs-7">Painel administrativo</small>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar menu"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <nav>
            <div class="sidebar-heading">Visão geral</div>
            <ul class="nav nav-pills flex-column gap-1">
                <li class="nav-item">
                    <a href="admin" class="nav-link-admin active">
                        <i class="bi bi-speedometer2" aria-hidden="true"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin/relatorios" class="nav-link-admin">
                        <i class="bi bi-bar-chart" aria-hidden="true"></i> Relatorios
                    </a>
                </li>
            </ul>

            <div class="sidebar-heading">Cadastros</div>
            <ul class="nav nav-pills flex-column gap-1">
                <li class="nav-item">
                    <a href="admin/produtos" class="nav-link-admin">
                        <i class="bi bi-box-seam" aria-hidden="true"></i> Produtos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin/categorias" class="nav-link-admin">
                        <i class="bi bi-tags" aria-hidden="true"></i> Categorias
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin/clientes" class="nav-link-admin">
                        <i class="bi bi-people" aria-hidden="true"></i> Clientes
                    </a>
                </li>
            </ul>

            <div class="sidebar-heading">Vendas</div>
            <ul class="nav nav-pills flex-column gap-1">
                <li class="nav-item">
                    <a href="admin/pedidos" class="nav-link-admin">
                        <i class="bi bi-cart-check" aria-hidden="true"></i> Pedidos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin/pagamentos" class="nav-link-admin">
                        <i class="bi bi-credit-card" aria-hidden="true"></i> Pagamentos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin/carrinhos" class="nav-link-admin">
                        <i class="bi bi-cart3" aria-hidden="true"></i> Carrinhos ativos
                    </a>
                </li>
            </ul>

            <div class="sidebar-heading">Controle</div>
            <ul class="nav nav-pills flex-column gap-1">
                <li class="nav-item">
                    <a href="admin/estoque" class="nav-link-admin">
                        <i class="bi bi-boxes" aria-hidden="true"></i> Estoque
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin/notificacoes" class="nav-link-admin">
                        <i class="bi bi-bell" aria-hidden="true"></i> Notificações
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin/contatos" class="nav-link-admin">
                        <i class="bi bi-envelope" aria-hidden="true"></i> Contatos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin/configuracoes" class="nav-link-admin">
                        <i class="bi bi-gear" aria-hidden="true"></i> Configurações
                    </a>
                </li>
            </ul>
        </nav>

        <div class="pt-3 border-top border-secondary mt-4 d-flex flex-column gap-2">
            <a href="" target="_blank" class="btn btn-outline-light btn-sm w-100 text-start d-flex align-items-center gap-2">
                <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Visualizar loja
            </a>
            
            <!-- NOTA: Token CSRF dinâmico necessário em conversão PHP[cite: 1] -->
            <form action="admin/sair" method="post" class="w-100">
                <button type="submit" class="btn btn-danger btn-sm w-100 text-start d-flex align-items-center gap-2">
                    <i class="bi bi-power" aria-hidden="true"></i> Sair do sistema
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Envoltório do Conteúdo Principal[cite: 1] -->
<div class="main-wrapper d-flex flex-column min-vh-100">
    
    <!-- 2. Barra Superior[cite: 1] -->
    <header class="top-navbar sticky-top bg-white border-bottom shadow-sm">
        <div class="container-fluid px-3 py-2 d-flex align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-secondary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-label="Abrir menu de navegação">[cite: 1]
                    <i class="bi bi-list fs-5" aria-hidden="true"></i>
                </button>
                
                <form action="admin/buscar" method="get" class="d-none d-md-flex" role="search">[cite: 1]
                    <label for="inputSearch" class="visually-hidden">Pesquisar registros no painel</label>[cite: 1]
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0" id="search-icon">
                            <i class="bi bi-search text-muted" aria-hidden="true"></i>[cite: 1]
                        </span>
                        <input type="search" name="q" id="inputSearch" class="form-control bg-light border-start-0 ps-0" placeholder="Pesquisar..." aria-label="Pesquisar registros" aria-describedby="search-icon">[cite: 1]
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="admin/notificacoes" class="btn btn-light btn-sm position-relative rounded-circle p-2 d-flex align-items-center justify-content-center" aria-label="Notificações: 5 não lidas">[cite: 1]
                    <i class="bi bi-bell fs-6" aria-hidden="true"></i>[cite: 1]
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        5[cite: 1]
                        <span class="visually-hidden">Notificações não lidas</span>
                    </span>
                </a>

                <div class="dropdown">
                    <button class="btn btn-light btn-sm dropdown-toggle d-flex align-items-center gap-2 border-0 bg-transparent" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" aria-hidden="true">A</span>
                        <span class="d-none d-sm-inline fw-medium text-dark">Administrador</span>[cite: 1]
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-menu-item dropdown-item d-flex align-items-center gap-2" href="admin/perfil"><i class="bi bi-person" aria-hidden="true"></i> Meu perfil</a></li>[cite: 1]
                        <li><a class="dropdown-menu-item dropdown-item d-flex align-items-center gap-2" href="admin/configuracoes"><i class="bi bi-gear" aria-hidden="true"></i> Configurações</a></li>[cite: 1]
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <!-- Token CSRF exigido via conversão PHP no backend[cite: 1] -->
                            <form action="admin/sair" method="post" class="m-0">[cite: 1]
                                <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">[cite: 1]
                                    <i class="bi bi-box-arrow-right" aria-hidden="true"></i> Sair do sistema[cite: 1]
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Área de Conteúdo Principal[cite: 1] -->
    <main class="flex-grow-1 p-3 p-md-4">
        <div class="container-fluid max-width-xl">

            <!-- 3. Cabeçalho da Página[cite: 1] -->
            <section class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">Dashboard administrativo</h1>[cite: 1]
                    <p class="text-muted mb-0">Acompanhe os principais dados e acesse os módulos da loja.</p>[cite: 1]
                </div>
                <div class="d-flex gap-2">
                    <a href="" target="_blank" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-2">[cite: 1]
                        <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Ver loja[cite: 1]
                    </a>
                    <a href="admin/produtos/novo" class="btn btn-primary btn-sm d-flex align-items-center gap-2">[cite: 1]
                        <i class="bi bi-plus-lg" aria-hidden="true"></i> Novo produto[cite: 1]
                    </a>
                </div>
            </section>

            <!-- 4. Cards de Indicadores[cite: 1] -->
            <section class="row g-3 mb-4" aria-label="Indicadores gerais do sistema">
                
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-stat h-100 border-0 shadow-sm border-start border-primary border-4 rounded-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Produtos cadastrados</span>[cite: 1]
                                <div class="p-2 bg-primary-subtle text-primary rounded-circle">
                                    <i class="bi bi-box-seam fs-5" aria-hidden="true"></i>
                                </div>
                            </div>
                            <h2 class="h3 fw-bold text-dark mb-1">248</h2>[cite: 1]
                            <p class="text-muted small mb-3"><span class="text-success fw-semibold"><i class="bi bi-arrow-up-short"></i> +12%</span> este mês</p>[cite: 1]
                            <a href="admin/produtos" class="stretched-link text-decoration-none small text-primary fw-medium">Ver produtos <i class="bi bi-arrow-right"></i></a>[cite: 1]
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-stat h-100 border-0 shadow-sm border-start border-info border-4 rounded-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Clientes cadastrados</span>[cite: 1]
                                <div class="p-2 bg-info-subtle text-info rounded-circle">
                                    <i class="bi bi-people fs-5" aria-hidden="true"></i>
                                </div>
                            </div>
                            <h2 class="h3 fw-bold text-dark mb-1">1.084</h2>[cite: 1]
                            <p class="text-muted small mb-3"><span class="text-success fw-semibold"><i class="bi bi-arrow-up-short"></i> +8%</span> este mês</p>[cite: 1]
                            <a href="admin/clientes" class="stretched-link text-decoration-none small text-info fw-medium">Ver clientes <i class="bi bi-arrow-right"></i></a>[cite: 1]
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-stat h-100 border-0 shadow-sm border-start border-warning border-4 rounded-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Pedidos pendentes</span>[cite: 1]
                                <div class="p-2 bg-warning-subtle text-warning rounded-circle">
                                    <i class="bi bi-clock-history fs-5" aria-hidden="true"></i>
                                </div>
                            </div>
                            <h2 class="h3 fw-bold text-dark mb-1">32</h2>[cite: 1]
                            <p class="text-muted small mb-3"><span class="text-warning fw-semibold">Requer atenção</span> prioridade alta</p>[cite: 1]
                            <a href="admin/pedidos" class="stretched-link text-decoration-none small text-warning fw-medium">Ver pedidos <i class="bi bi-arrow-right"></i></a>[cite: 1]
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-stat h-100 border-0 shadow-sm border-start border-danger border-4 rounded-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Estoque baixo</span>[cite: 1]
                                <div class="p-2 bg-danger-subtle text-danger rounded-circle">
                                    <i class="bi bi-exclamation-triangle fs-5" aria-hidden="true"></i>
                                </div>
                            </div>
                            <h2 class="h3 fw-bold text-dark mb-1">14</h2>[cite: 1]
                            <p class="text-muted small mb-3"><span class="text-danger fw-semibold">Abaixo do limite</span> reposição necessária</p>[cite: 1]
                            <a href="admin/estoque?filtro=baixo" class="stretched-link text-decoration-none small text-danger fw-medium">Ver estoque <i class="bi bi-arrow-right"></i></a>[cite: 1]
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-stat h-100 border-0 shadow-sm border-start border-secondary border-4 rounded-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Carrinhos ativos</span>[cite: 1]
                                <div class="p-2 bg-secondary-subtle text-secondary rounded-circle">
                                    <i class="bi bi-cart3 fs-5" aria-hidden="true"></i>
                                </div>
                            </div>
                            <h2 class="h3 fw-bold text-dark mb-1">46</h2>[cite: 1]
                            <p class="text-muted small mb-3">Sessões ativas no momento</p>[cite: 1]
                            <a href="admin/carrinhos" class="stretched-link text-decoration-none small text-secondary fw-medium">Ver carrinhos <i class="bi bi-arrow-right"></i></a>[cite: 1]
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-stat h-100 border-0 shadow-sm border-start border-success border-4 rounded-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Pagamentos confirmados</span>[cite: 1]
                                <div class="p-2 bg-success-subtle text-success rounded-circle">
                                    <i class="bi bi-currency-dollar fs-5" aria-hidden="true"></i>
                                </div>
                            </div>
                            <h2 class="h3 fw-bold text-dark mb-1">R$ 28.640</h2>[cite: 1]
                            <p class="text-muted small mb-3"><span class="text-success fw-semibold"><i class="bi bi-arrow-up-short"></i> +15%</span> total mensal</p>[cite: 1]
                            <a href="admin/pagamentos" class="stretched-link text-decoration-none small text-success fw-medium">Ver pagamentos <i class="bi bi-arrow-right"></i></a>[cite: 1]
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-stat h-100 border-0 shadow-sm border-start border-primary border-4 rounded-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Notificações</span>[cite: 1]
                                <div class="p-2 bg-primary-subtle text-primary rounded-circle">
                                    <i class="bi bi-bell fs-5" aria-hidden="true"></i>
                                </div>
                            </div>
                            <h2 class="h3 fw-bold text-dark mb-1">5</h2>[cite: 1]
                            <p class="text-muted small mb-3">Pendentes de leitura</p>[cite: 1]
                            <a href="admin/notificacoes" class="stretched-link text-decoration-none small text-primary fw-medium">Ver notificações <i class="bi bi-arrow-right"></i></a>[cite: 1]
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-stat h-100 border-0 shadow-sm border-start border-dark border-4 rounded-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Contatos recebidos</span>[cite: 1]
                                <div class="p-2 bg-dark-subtle text-dark rounded-circle">
                                    <i class="bi bi-chat-dots fs-5" aria-hidden="true"></i>
                                </div>
                            </div>
                            <h2 class="h3 fw-bold text-dark mb-1">18</h2>[cite: 1]
                            <p class="text-muted small mb-3">Mensagens em aberto</p>[cite: 1]
                            <a href="admin/contatos" class="stretched-link text-decoration-none small text-dark fw-medium">Ver contatos <i class="bi bi-arrow-right"></i></a>[cite: 1]
                        </div>
                    </div>
                </div>

            </section>

            <!-- 5. Acessos Rápido[cite: 1] -->
            <section class="mb-4">
                <h2 class="h5 fw-bold text-dark mb-3">Acessos rápidos</h2>[cite: 1]
                <div class="row g-3">
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="admin/produtos" class="card card-quick-access h-100 border-0 shadow-sm rounded-3 p-3 text-center">[cite: 1]
                            <i class="bi bi-box-seam fs-2 text-primary mb-2 d-block" aria-hidden="true"></i>[cite: 1]
                            <h3 class="h6 fw-bold mb-1">Produtos</h3>[cite: 1]
                            <span class="text-muted fs-7">Gerenciar catálogo</span>[cite: 1]
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="admin/clientes" class="card card-quick-access h-100 border-0 shadow-sm rounded-3 p-3 text-center">[cite: 1]
                            <i class="bi bi-people fs-2 text-info mb-2 d-block" aria-hidden="true"></i>[cite: 1]
                            <h3 class="h6 fw-bold mb-1">Clientes</h3>[cite: 1]
                            <span class="text-muted fs-7">Base de usuários</span>[cite: 1]
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="admin/pedidos" class="card card-quick-access h-100 border-0 shadow-sm rounded-3 p-3 text-center">[cite: 1]
                            <i class="bi bi-cart-check fs-2 text-warning mb-2 d-block" aria-hidden="true"></i>[cite: 1]
                            <h3 class="h6 fw-bold mb-1">Pedidos</h3>[cite: 1]
                            <span class="text-muted fs-7">Vendas efetuadas</span>[cite: 1]
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="admin/pagamentos" class="card card-quick-access h-100 border-0 shadow-sm rounded-3 p-3 text-center">[cite: 1]
                            <i class="bi bi-credit-card fs-2 text-success mb-2 d-block" aria-hidden="true"></i>[cite: 1]
                            <h3 class="h6 fw-bold mb-1">Pagamentos</h3>[cite: 1]
                            <span class="text-muted fs-7">Fluxo financeiro</span>[cite: 1]
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="admin/estoque" class="card card-quick-access h-100 border-0 shadow-sm rounded-3 p-3 text-center">[cite: 1]
                            <i class="bi bi-boxes fs-2 text-danger mb-2 d-block" aria-hidden="true"></i>[cite: 1]
                            <h3 class="h6 fw-bold mb-1">Estoque</h3>[cite: 1]
                            <span class="text-muted fs-7">Nível de produtos</span>[cite: 1]
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="admin/relatorios" class="card card-quick-access h-100 border-0 shadow-sm rounded-3 p-3 text-center">[cite: 1]
                            <i class="bi bi-bar-chart fs-2 text-dark mb-2 d-block" aria-hidden="true"></i>[cite: 1]
                            <h3 class="h6 fw-bold mb-1">Relatórios</h3>[cite: 1]
                            <span class="text-muted fs-7">Análise de dados</span>[cite: 1]
                        </a>
                    </div>
                </div>
            </section>

            <div class="row g-4 mb-4">
                <!-- 6. Pedidos Recentes[cite: 1] -->
                <section class="col-12 col-xl-7">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
                            <h2 class="h5 fw-bold mb-0 text-dark">Pedidos recentes</h2>[cite: 1]
                            <a href="admin/pedidos" class="btn btn-sm btn-outline-primary">Ver todos</a>[cite: 1]
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">[cite: 1]
                                <table class="table table-hover align-middle mb-0">
                                    <caption class="visually-hidden">Lista de pedidos recentes realizados no sistema</caption>[cite: 1]
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Pedido</th>[cite: 1]
                                            <th scope="col">Cliente</th>[cite: 1]
                                            <th scope="col">Data</th>[cite: 1]
                                            <th scope="col">Total</th>[cite: 1]
                                            <th scope="col">Status</th>[cite: 1]
                                            <th scope="col" class="text-end">Ação</th>[cite: 1]
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-semibold">#1058</td>[cite: 1]
                                            <td>Mariana Alves</td>[cite: 1]
                                            <td>05/08/2026</td>[cite: 1]
                                            <td>R$ 1.249,90</td>[cite: 1]
                                            <td><span class="badge bg-warning text-dark badge-status">Aguardando</span></td>[cite: 1]
                                            <td class="text-end">
                                                <a href="admin/pedidos/1058" class="btn btn-sm btn-light border" aria-label="Visualizar pedido 1058">[cite: 1]
                                                    <i class="bi bi-eye" aria-hidden="true"></i>[cite: 1]
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">#1057</td>
                                            <td>Carlos Eduardo</td>
                                            <td>05/08/2026</td>
                                            <td>R$ 350,00</td>
                                            <td><span class="badge bg-success badge-status">Pago</span></td>[cite: 1]
                                            <td class="text-end">
                                                <a href="admin/pedidos/1057" class="btn btn-sm btn-light border" aria-label="Visualizar pedido 1057">
                                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">#1056</td>
                                            <td>Fernanda Souza</td>
                                            <td>04/08/2026</td>
                                            <td>R$ 89,90</td>
                                            <td><span class="badge bg-info text-dark badge-status">Em separação</span></td>[cite: 1]
                                            <td class="text-end">
                                                <a href="admin/pedidos/1056" class="btn btn-sm btn-light border" aria-label="Visualizar pedido 1056">
                                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">#1055</td>
                                            <td>Lucas Mendes</td>
                                            <td>04/08/2026</td>
                                            <td>R$ 2.100,00</td>
                                            <td><span class="badge bg-primary badge-status">Enviado</span></td>[cite: 1]
                                            <td class="text-end">
                                                <a href="admin/pedidos/1055" class="btn btn-sm btn-light border" aria-label="Visualizar pedido 1055">
                                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">#1054</td>
                                            <td>Beatriz Lima</td>
                                            <td>03/08/2026</td>
                                            <td>R$ 412,50</td>
                                            <td><span class="badge bg-secondary badge-status">Entregue</span></td>[cite: 1]
                                            <td class="text-end">
                                                <a href="admin/pedidos/1054" class="btn btn-sm btn-light border" aria-label="Visualizar pedido 1054">
                                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">#1053</td>
                                            <td>João Pedro Santos</td>
                                            <td>03/08/2026</td>
                                            <td>R$ 150,00</td>
                                            <td><span class="badge bg-danger badge-status">Cancelado</span></td>[cite: 1]
                                            <td class="text-end">
                                                <a href="admin/pedidos/1053" class="btn btn-sm btn-light border" aria-label="Visualizar pedido 1053">
                                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- 7. Produtos com Estoque Baixo[cite: 1] -->
                <section class="col-12 col-xl-5">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
                            <h2 class="h5 fw-bold mb-0 text-dark">Produtos com estoque baixo</h2>[cite: 1]
                            <a href="admin/estoque?filtro=baixo" class="btn btn-sm btn-outline-danger">Ver relatório</a>[cite: 1]
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">[cite: 1]
                                <table class="table table-hover align-middle mb-0">
                                    <caption class="visually-hidden">Lista de produtos que estão com estoque crítico ou baixo</caption>[cite: 1]
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Produto</th>[cite: 1]
                                            <th scope="col" class="text-center">Atual</th>[cite: 1]
                                            <th scope="col" class="text-center">Mínimo</th>[cite: 1]
                                            <th scope="col">Situação</th>[cite: 1]
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-medium">Mouse sem fio</td>[cite: 1]
                                            <td class="text-center fw-bold text-danger">2</td>[cite: 1]
                                            <td class="text-center text-muted">10</td>[cite: 1]
                                            <td><span class="badge bg-danger-subtle text-danger border border-danger-subtle">Crítico</span></td>[cite: 1]
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Teclado Mecânico RGB</td>
                                            <td class="text-center fw-bold text-danger">3</td>
                                            <td class="text-center text-muted">15</td>
                                            <td><span class="badge bg-danger-subtle text-danger border border-danger-subtle">Crítico</span></td>[cite: 1]
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Monitor UltraWide 29"</td>
                                            <td class="text-center fw-bold text-warning">5</td>
                                            <td class="text-center text-muted">8</td>
                                            <td><span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">Baixo</span></td>[cite: 1]
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Headset Gamer 7.1</td>
                                            <td class="text-center fw-bold text-warning">4</td>
                                            <td class="text-center text-muted">10</td>
                                            <td><span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">Baixo</span></td>[cite: 1]
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="row g-4">
                <!-- 8. Painel de Notificações[cite: 1] -->
                <section class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
                            <h2 class="h5 fw-bold mb-0 text-dark">Notificações</h2>[cite: 1]
                            <a href="admin/notificacoes" class="btn btn-sm btn-link text-decoration-none">Ver todas</a>[cite: 1]
                        </div>
                        <div class="card-body pt-0">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-0 py-3 border-bottom">
                                    <div class="d-flex gap-3 align-items-start">
                                        <div class="p-2 bg-danger-subtle text-danger rounded-circle mt-1">
                                            <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>[cite: 1]
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h3 class="h6 fw-bold mb-1">Estoque crítico detectado</h3>[cite: 1]
                                                <small class="text-muted fs-7">Há 10 min</small>
                                            </div>
                                            <p class="text-muted small mb-2">O produto "Mouse sem fio" atingiu a quantidade crítica de apenas 2 unidades em estoque.</p>[cite: 1]
                                            <a href="admin/produtos/mouse-sem-fio" class="small fw-semibold text-decoration-none text-danger">Ajustar estoque <i class="bi bi-arrow-right"></i></a>[cite: 1]
                                        </div>
                                    </div>
                                </div>

                                <div class="list-group-item px-0 py-3 border-bottom">
                                    <div class="d-flex gap-3 align-items-start">
                                        <div class="p-2 bg-warning-subtle text-warning-emphasis rounded-circle mt-1">
                                            <i class="bi bi-clock-fill" aria-hidden="true"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h3 class="h6 fw-bold mb-1">Pagamento aguardando confirmação</h3>[cite: 1]
                                                <small class="text-muted fs-7">Há 35 min</small>
                                            </div>
                                            <p class="text-muted small mb-2">O pedido #1058 via Transferência Pix necessita de validação do comprovante pelo gestor.</p>[cite: 1]
                                            <a href="admin/pedidos/1058" class="small fw-semibold text-decoration-none text-warning-emphasis">Validar pagamento <i class="bi bi-arrow-right"></i></a>[cite: 1]
                                        </div>
                                    </div>
                                </div>

                                <div class="list-group-item px-0 py-3 border-bottom">
                                    <div class="d-flex gap-3 align-items-start">
                                        <div class="p-2 bg-info-subtle text-info rounded-circle mt-1">
                                            <i class="bi bi-chat-left-text-fill" aria-hidden="true"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h3 class="h6 fw-bold mb-1">Nova mensagem de contato</h3>[cite: 1]
                                                <small class="text-muted fs-7">Há 1 hora</small>
                                            </div>
                                            <p class="text-muted small mb-2">O cliente Carlos enviou uma solicitação referente ao prazo de entrega da categoria de periféricos.</p>[cite: 1]
                                            <a href="admin/contatos" class="small fw-semibold text-decoration-none text-info">Responder mensagem <i class="bi bi-arrow-right"></i></a>[cite: 1]
                                        </div>
                                    </div>
                                </div>

                                <div class="list-group-item px-0 py-3 border-0">
                                    <div class="d-flex gap-3 align-items-start">
                                        <div class="p-2 bg-primary-subtle text-primary rounded-circle mt-1">
                                            <i class="bi bi-box-seam-fill" aria-hidden="true"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h3 class="h6 fw-bold mb-1">Pedido aguardando separação</h3>[cite: 1]
                                                <small class="text-muted fs-7">Há 2 horas</small>
                                            </div>
                                            <p class="text-muted small mb-2">O pedido #1056 teve o pagamento aprovado e aguarda expedição no almoxarifado.</p>[cite: 1]
                                            <a href="admin/pedidos" class="small fw-semibold text-decoration-none text-primary">Ver fila de logística <i class="bi bi-arrow-right"></i></a>[cite: 1]
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- 9. Resumo Operacional[cite: 1] -->
                <section class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h2 class="h5 fw-bold mb-0 text-dark">Resumo operacional</h2>[cite: 1]
                        </div>
                        <div class="card-body pt-0 d-flex flex-column justify-content-between">
                            <div class="d-flex flex-column gap-4 my-auto">
                                <div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="fw-medium text-dark">Pedidos processados</span>[cite: 1]
                                        <span class="fw-bold text-primary">74%</span>[cite: 1]
                                    </div>
                                    <div class="progress" style="height: 10px;" role="progressbar" aria-label="Meta de pedidos processados" aria-valuenow="74" aria-valuemin="0" aria-valuemax="100">[cite: 1]
                                        <div class="progress-bar bg-primary" style="width: 74%"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="fw-medium text-dark">Pagamentos confirmados</span>[cite: 1]
                                        <span class="fw-bold text-success">86%</span>[cite: 1]
                                    </div>
                                    <div class="progress" style="height: 10px;" role="progressbar" aria-label="Meta de pagamentos confirmados" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100">[cite: 1]
                                        <div class="progress-bar bg-success" style="width: 86%"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="fw-medium text-dark">Mensagens respondidas</span>[cite: 1]
                                        <span class="fw-bold text-info">63%</span>[cite: 1]
                                    </div>
                                    <div class="progress" style="height: 10px;" role="progressbar" aria-label="Meta de mensagens respondidas" aria-valuenow="63" aria-valuemin="0" aria-valuemax="100">[cite: 1]
                                        <div class="progress-bar bg-info" style="width: 63%"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="fw-medium text-dark">Pedidos enviados</span>[cite: 1]
                                        <span class="fw-bold text-warning">70%</span>[cite: 1]
                                    </div>
                                    <div class="progress" style="height: 10px;" role="progressbar" aria-label="Meta de pedidos enviados" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">[cite: 1]
                                        <div class="progress-bar bg-warning" style="width: 70%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 border-top mt-3">
                                <a href="admin/relatorios" class="btn btn-outline-primary w-100 fw-medium">[cite: 1]
                                    <i class="bi bi-file-earmark-bar-graph me-1" aria-hidden="true"></i> Acessar relatórios[cite: 1]
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </main>

    <!-- 10. Rodapé Administrativo[cite: 1] -->
    <footer class="bg-white border-top py-3 mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2 text-muted small">
                <div>
                    &copy; <span id="currentYear"></span> <strong class="text-dark">Loja Online</strong> - Painel administrativo.[cite: 1]
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check text-success fs-6" aria-hidden="true"></i>[cite: 1]
                    <span>Ambiente protegido e criptografado</span>[cite: 1]
                </div>
            </div>
        </div>
    </footer>

</div>

<!-- Bootstrap Bundle (JS + Popper)[cite: 1] -->
<script src="[https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js](https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js)"></script>[cite: 1]

<!-- Scripts em JS Puro[cite: 1] -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Atualização dinâmica do ano do rodapé[cite: 1]
        var yearSpan = document.getElementById("currentYear");
        if (yearSpan) {
            yearSpan.textContent = new Date().getFullYear();
        }

        // Identificação de rota para o link ativo do menu[cite: 1]
        var currentPath = window.location.pathname;
        var navLinks = document.querySelectorAll(".nav-link-admin");

        navLinks.forEach(function (link) {
            var href = link.getAttribute("href");
            if (href && currentPath.endsWith(href)) {
                link.classList.add("active");
            }
        });
    });
</script>

```

<?php

require APP_ROOT
    . '/views/layouts/admin/footer.php';
