<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Configurações -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrativo | Loja Online</title>
    <meta name="description" content="Painel administrativo da Loja Online para gerenciamento de produtos, clientes, pedidos, pagamentos e estoque.">
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <base href="/loja_online/public/">

    <!-- Bootstrap 5.3.8 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons 1.13.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sidebar-width: 260px;
            --topbar-height: 60px;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #0d6efd;
            --main-bg: #f8fafc;
        }

        body {
            background-color: var(--main-bg);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #334155;
        }

        /* Menu Lateral Desktop */
        .sidebar-desktop {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
            background-color: var(--sidebar-bg);
            color: #f8fafc;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        /* Custom Scrollbar Menu Lateral */
        .sidebar-desktop::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-desktop::-webkit-scrollbar-thumb {
            background-color: #475569;
            border-radius: 3px;
        }

        /* Wrapper do Conteúdo Principal */
        .main-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        @media (min-width: 992px) {
            .main-wrapper {
                margin-left: var(--sidebar-width);
            }
        }

        /* Barra Superior */
        .topbar {
            height: var(--topbar-height);
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        /* Links do Menu */
        .nav-section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            padding: 0.75rem 1.25rem 0.25rem;
            font-weight: 700;
        }

        .sidebar-nav .nav-link {
            color: #cbd5e1;
            padding: 0.6rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }

        .sidebar-nav .nav-link:hover {
            color: #ffffff;
            background-color: var(--sidebar-hover);
        }

        .sidebar-nav .nav-link.active {
            color: #ffffff;
            background-color: var(--sidebar-hover);
            border-left-color: var(--sidebar-active);
            font-weight: 600;
        }

        /* Estilização dos Cards */
        .stat-card {
            border: none;
            border-radius: 0.5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .quick-access-card {
            border: none;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .quick-access-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
            color: #0d6efd;
        }

        /* Elementos de Notificação */
        .notification-item {
            border-left: 3px solid transparent;
            transition: background-color 0.2s ease;
        }

        .notification-item:hover {
            background-color: #f1f5f9;
        }

        .notification-item.unread {
            border-left-color: #0d6efd;
            background-color: #f8fafc;
        }

        .avatar-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #0d6efd;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>

    <!--
    SEGURANÇA & PHP NOTES:
    - Esta página deverá ser convertida para dashboard.php na integração.
    - O acesso deve ocorrer estritamente via controlador de rotas (routes/admin.php) e nunca diretamente via arquivo em views/.
    - O administrador DEVE estar autenticado via sessão/middleware antes de renderizar esta view.
    - Todos os valores e contadores devem ser buscados dinamicamente no banco de dados.
    - Os formulários com method="post" DEVEM conter o token CSRF (<input type="hidden" name="csrf_token" value="...">).
    -->

    <!-- Menu lateral Desktop -->
    <aside class="sidebar-desktop d-none d-lg-flex" aria-label="Navegação Principal Desktop">
        <div class="p-3 border-bottom border-secondary border-opacity-25 d-flex align-items-center gap-2">
            <i class="bi bi-shop fs-3 text-primary" aria-hidden="true"></i>
            <div>
                <span class="fw-bold d-block lh-1 text-white">Loja Online</span>
                <small class="text-white-50 fs-7">Painel administrativo</small>
            </div>
        </div>

        <nav class="sidebar-nav my-2 flex-grow-1">
            <div class="nav-section-title">Visão geral</div>
            <a href="admin" class="nav-link">
                <i class="bi bi-speedometer2" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>
            <a href="admin/relatorios" class="nav-link">
                <i class="bi bi-bar-chart-line" aria-hidden="true"></i>
                <span>Relatórios</span>
            </a>

            <div class="nav-section-title">Cadastros</div>
            <a href="admin/produtos" class="nav-link">
                <i class="bi bi-box-seam" aria-hidden="true"></i>
                <span>Produtos</span>
            </a>
            <a href="admin/categorias" class="nav-link">
                <i class="bi bi-tags" aria-hidden="true"></i>
                <span>Categorias</span>
            </a>
            <a href="admin/clientes" class="nav-link">
                <i class="bi bi-people" aria-hidden="true"></i>
                <span>Clientes</span>
            </a>

            <div class="nav-section-title">Vendas</div>
            <a href="admin/pedidos" class="nav-link">
                <i class="bi bi-cart-check" aria-hidden="true"></i>
                <span>Pedidos</span>
            </a>
            <a href="admin/pagamentos" class="nav-link">
                <i class="bi bi-credit-card" aria-hidden="true"></i>
                <span>Pagamentos</span>
            </a>
            <a href="admin/carrinhos" class="nav-link">
                <i class="bi bi-cart3" aria-hidden="true"></i>
                <span>Carrinhos ativos</span>
            </a>

            <div class="nav-section-title">Controle</div>
            <a href="admin/estoque" class="nav-link">
                <i class="bi bi-boxes" aria-hidden="true"></i>
                <span>Estoque</span>
            </a>
            <a href="admin/notificacoes" class="nav-link">
                <i class="bi bi-bell" aria-hidden="true"></i>
                <span>Notificações</span>
            </a>
            <a href="admin/contatos" class="nav-link">
                <i class="bi bi-envelope-paper" aria-hidden="true"></i>
                <span>Contatos</span>
            </a>
            <a href="admin/configuracoes" class="nav-link">
                <i class="bi bi-gear" aria-hidden="true"></i>
                <span>Configurações</span>
            </a>
        </nav>

        <div class="p-3 border-top border-secondary border-opacity-25">
            <a href="" target="_blank" class="btn btn-outline-light btn-sm w-100 mb-2 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                <span>Visualizar loja</span>
            </a>
            <!-- CSRF Token deverá ser acrescentado aqui quando convertido para PHP -->
            <form action="admin/sair" method="post">
                <button type="submit" class="btn btn-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-sign-out" aria-hidden="true"></i>
                    <span>Sair do sistema</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Menu móvel (Offcanvas para Mobile/Tablet) -->
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="sidebarMobile" aria-labelledby="sidebarMobileLabel">
        <div class="offcanvas-header border-bottom border-secondary border-opacity-25">
            <div class="d-flex align-items-center gap-2" id="sidebarMobileLabel">
                <i class="bi bi-shop fs-3 text-primary" aria-hidden="true"></i>
                <div>
                    <span class="fw-bold d-block lh-1 text-white">Loja Online</span>
                    <small class="text-white-50">Painel administrativo</small>
                </div>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar menu"></button>
        </div>
        <div class="offcanvas-body p-0 d-flex flex-column">
            <nav class="sidebar-nav my-2 flex-grow-1">
                <div class="nav-section-title">Visão geral</div>
                <a href="admin" class="nav-link">
                    <i class="bi bi-speedometer2" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </a>
                <a href="admin/relatorios" class="nav-link">
                    <i class="bi bi-bar-chart-line" aria-hidden="true"></i>
                    <span>Relatórios</span>
                </a>

                <div class="nav-section-title">Cadastros</div>
                <a href="admin/produtos" class="nav-link">
                    <i class="bi bi-box-seam" aria-hidden="true"></i>
                    <span>Produtos</span>
                </a>
                <a href="admin/categorias" class="nav-link">
                    <i class="bi bi-tags" aria-hidden="true"></i>
                    <span>Categorias</span>
                </a>
                <a href="admin/clientes" class="nav-link">
                    <i class="bi bi-people" aria-hidden="true"></i>
                    <span>Clientes</span>
                </a>

                <div class="nav-section-title">Vendas</div>
                <a href="admin/pedidos" class="nav-link">
                    <i class="bi bi-cart-check" aria-hidden="true"></i>
                    <span>Pedidos</span>
                </a>
                <a href="admin/pagamentos" class="nav-link">
                    <i class="bi bi-credit-card" aria-hidden="true"></i>
                    <span>Pagamentos</span>
                </a>
                <a href="admin/carrinhos" class="nav-link">
                    <i class="bi bi-cart3" aria-hidden="true"></i>
                    <span>Carrinhos ativos</span>
                </a>

                <div class="nav-section-title">Controle</div>
                <a href="admin/estoque" class="nav-link">
                    <i class="bi bi-boxes" aria-hidden="true"></i>
                    <span>Estoque</span>
                </a>
                <a href="admin/notificacoes" class="nav-link">
                    <i class="bi bi-bell" aria-hidden="true"></i>
                    <span>Notificações</span>
                </a>
                <a href="admin/contatos" class="nav-link">
                    <i class="bi bi-envelope-paper" aria-hidden="true"></i>
                    <span>Contatos</span>
                </a>
                <a href="admin/configuracoes" class="nav-link">
                    <i class="bi bi-gear" aria-hidden="true"></i>
                    <span>Configurações</span>
                </a>
            </nav>

            <div class="p-3 border-top border-secondary border-opacity-25 mt-auto">
                <a href="" target="_blank" class="btn btn-outline-light btn-sm w-100 mb-2 d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                    <span>Visualizar loja</span>
                </a>
                <!-- CSRF Token deverá ser acrescentado aqui quando convertido para PHP -->
                <form action="admin/sair" method="post">
                    <button type="submit" class="btn btn-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-sign-out" aria-hidden="true"></i>
                        <span>Sair do sistema</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="main-wrapper">
        <!-- Barra superior -->
        <header class="topbar px-3 px-lg-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none p-1 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile" aria-controls="sidebarMobile" aria-label="Abrir menu de navegação">
                    <i class="bi bi-list fs-3" aria-hidden="true"></i>
                </button>

                <form class="d-none d-md-flex align-items-center" action="admin/buscar" method="get" role="search">
                    <div class="input-group input-group-sm">
                        <label for="search-input" class="visually-hidden">Pesquisar no sistema</label>
                        <span class="input-group-text bg-light border-end-0" id="search-icon">
                            <i class="bi bi-search text-muted" aria-hidden="true"></i>
                        </span>
                        <input type="search" id="search-input" name="q" class="form-control bg-light border-start-0" placeholder="Pesquisar..." aria-label="Pesquisar no sistema" aria-describedby="search-icon">
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center gap-3">
                <!-- Ícone Notificações -->
                <a href="admin/notificacoes" class="btn btn-light position-relative p-2 border-0 rounded-circle" aria-label="Notificações: 5 não lidas">
                    <i class="bi bi-bell fs-5" aria-hidden="true"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        5
                        <span class="visually-hidden">notificações não lidas</span>
                    </span>
                </a>

                <!-- Menu do Perfil -->
                <div class="dropdown">
                    <button class="btn btn-link p-0 text-decoration-none border-0 d-flex align-items-center gap-2" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar-circle">AD</div>
                        <span class="fw-semibold text-dark d-none d-sm-inline fs-7">Administrador</span>
                        <i class="bi bi-chevron-down text-muted fs-7" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" aria-labelledby="userMenu">
                        <li>
                            <h6 class="dropdown-header">Minha Conta</h6>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="admin/perfil">
                                <i class="bi bi-person me-1" aria-hidden="true"></i> Meu perfil
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="admin/configuracoes">
                                <i class="bi bi-gear me-1" aria-hidden="true"></i> Configurações
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <!-- CSRF Token deverá ser acrescentado aqui quando convertido para PHP -->
                            <form action="admin/sair" method="post" class="px-2">
                                <button type="submit" class="dropdown-item text-danger rounded d-flex align-items-center gap-2">
                                    <i class="bi bi-box-arrow-right me-1" aria-hidden="true"></i> Sair
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Área Principal -->
        <main class="p-3 p-lg-4 flex-grow-1" id="main-content">
            <!-- Cabeçalho da página -->
            <section class="mb-4">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
                    <div>
                        <h1 class="h3 fw-bold text-dark mb-1">Dashboard administrativo</h1>
                        <p class="text-muted mb-0">Acompanhe os principais dados e acesse os módulos da loja.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="" target="_blank" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                            <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                            <span>Ver loja</span>
                        </a>
                        <a href="admin/produtos/novo" class="btn btn-primary d-flex align-items-center gap-2">
                            <i class="bi bi-plus-lg" aria-hidden="true"></i>
                            <span>Novo produto</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Cards de indicadores -->
            <section class="mb-4" aria-label="Indicadores do sistema">
                <div class="row g-3">
                    <!-- Card 1: Produtos Cadastrados -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="text-muted fw-semibold small">Produtos Cadastrados</span>
                                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                                        <i class="bi bi-box-seam" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <h2 class="h3 fw-bold mb-1">248</h2>
                                <p class="text-muted small mb-3"><i class="bi bi-arrow-up-short text-success" aria-hidden="true"></i> +12 este mês</p>
                                <a href="admin/produtos" class="text-primary text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                                    Gerenciar produtos <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Clientes Cadastrados -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="text-muted fw-semibold small">Clientes Cadastrados</span>
                                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                                        <i class="bi bi-people" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <h2 class="h3 fw-bold mb-1">1.084</h2>
                                <p class="text-muted small mb-3"><i class="bi bi-arrow-up-short text-success" aria-hidden="true"></i> +34 esta semana</p>
                                <a href="admin/clientes" class="text-info text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                                    Ver clientes <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Pedidos Pendentes -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="text-muted fw-semibold small">Pedidos Pendentes</span>
                                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-clock-history" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <h2 class="h3 fw-bold mb-1">32</h2>
                                <p class="text-muted small mb-3"><i class="bi bi-exclamation-circle text-warning" aria-hidden="true"></i> Requer atenção</p>
                                <a href="admin/pedidos" class="text-warning text-darken-2 text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                                    Processar pedidos <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Estoque Baixo -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="text-muted fw-semibold small">Estoque Baixo</span>
                                    <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                                        <i class="bi bi-exclamation-triangle" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <h2 class="h3 fw-bold mb-1">14</h2>
                                <p class="text-muted small mb-3"><i class="bi bi-arrow-down-short text-danger" aria-hidden="true"></i> Abaixo do mínimo</p>
                                <a href="admin/estoque?filtro=baixo" class="text-danger text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                                    Repor estoque <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5: Carrinhos Ativos -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="text-muted fw-semibold small">Carrinhos Ativos</span>
                                    <div class="stat-icon bg-secondary bg-opacity-10 text-secondary">
                                        <i class="bi bi-cart3" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <h2 class="h3 fw-bold mb-1">46</h2>
                                <p class="text-muted small mb-3">Sessões em andamento</p>
                                <a href="admin/carrinhos" class="text-secondary text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                                    Monitorar carrinhos <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6: Pagamentos Confirmados -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="text-muted fw-semibold small">Pagamentos Confirmados</span>
                                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-currency-dollar" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <h2 class="h3 fw-bold mb-1">R$ 28.640</h2>
                                <p class="text-muted small mb-3"><i class="bi bi-arrow-up-short text-success" aria-hidden="true"></i> +18% este mês</p>
                                <a href="admin/pagamentos" class="text-success text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                                    Ver financeiro <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 7: Notificações -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="text-muted fw-semibold small">Notificações</span>
                                    <div class="stat-icon bg-dark bg-opacity-10 text-dark">
                                        <i class="bi bi-bell" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <h2 class="h3 fw-bold mb-1">5</h2>
                                <p class="text-muted small mb-3">Não lidas no sistema</p>
                                <a href="admin/notificacoes" class="text-dark text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                                    Ver central <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 8: Contatos Recebidos -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="text-muted fw-semibold small">Contatos Recebidos</span>
                                    <div class="stat-icon bg-indigo bg-opacity-10 text-primary">
                                        <i class="bi bi-envelope-open" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <h2 class="h3 fw-bold mb-1">18</h2>
                                <p class="text-muted small mb-3">Mensagens de clientes</p>
                                <a href="admin/contatos" class="text-primary text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                                    Responder mensagens <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Acessos rápidos -->
            <section class="mb-4" aria-labelledby="quick-access-title">
                <h2 id="quick-access-title" class="h5 fw-bold mb-3">Acessos rápidos</h2>
                <div class="row g-3">
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="admin/produtos" class="card quick-access-card shadow-sm p-3 text-center h-100">
                            <i class="bi bi-box-seam fs-2 mb-2 text-primary" aria-hidden="true"></i>
                            <h3 class="h6 fw-bold mb-1">Produtos</h3>
                            <span class="text-muted small">Gerenciar itens</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="admin/clientes" class="card quick-access-card shadow-sm p-3 text-center h-100">
                            <i class="bi bi-people fs-2 mb-2 text-info" aria-hidden="true"></i>
                            <h3 class="h6 fw-bold mb-1">Clientes</h3>
                            <span class="text-muted small">Base de usuários</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="admin/pedidos" class="card quick-access-card shadow-sm p-3 text-center h-100">
                            <i class="bi bi-cart-check fs-2 mb-2 text-warning" aria-hidden="true"></i>
                            <h3 class="h6 fw-bold mb-1">Pedidos</h3>
                            <span class="text-muted small">Vendas realizadas</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="admin/pagamentos" class="card quick-access-card shadow-sm p-3 text-center h-100">
                            <i class="bi bi-credit-card fs-2 mb-2 text-success" aria-hidden="true"></i>
                            <h3 class="h6 fw-bold mb-1">Pagamentos</h3>
                            <span class="text-muted small">Fluxo financeiro</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="admin/estoque" class="card quick-access-card shadow-sm p-3 text-center h-100">
                            <i class="bi bi-boxes fs-2 mb-2 text-danger" aria-hidden="true"></i>
                            <h3 class="h6 fw-bold mb-1">Estoque</h3>
                            <span class="text-muted small">Controle de itens</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="admin/relatorios" class="card quick-access-card shadow-sm p-3 text-center h-100">
                            <i class="bi bi-bar-chart-line fs-2 mb-2 text-dark" aria-hidden="true"></i>
                            <h3 class="h6 fw-bold mb-1">Relatórios</h3>
                            <span class="text-muted small">Análise de dados</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Tabelas e Painéis -->
            <div class="row g-4 mb-4">
                <!-- Pedidos recentes -->
                <div class="col-12 col-xl-7">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                            <h2 class="h5 fw-bold mb-0">Pedidos recentes</h2>
                            <a href="admin/pedidos" class="btn btn-outline-primary btn-sm">Ver todos</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <caption class="visually-hidden">Lista de pedidos recentes recebidos na loja</caption>
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Pedido</th>
                                            <th scope="col">Cliente</th>
                                            <th scope="col">Data</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" class="text-end">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-semibold">#1058</td>
                                            <td>Mariana Alves</td>
                                            <td>05/08/2026</td>
                                            <td>R$ 1.249,90</td>
                                            <td><span class="badge bg-warning text-dark">Aguardando</span></td>
                                            <td class="text-end">
                                                <a href="admin/pedidos/1058" class="btn btn-light btn-sm" aria-label="Visualizar pedido 1058">
                                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">#1057</td>
                                            <td>Carlos Eduardo</td>
                                            <td>05/08/2026</td>
                                            <td>R$ 389,00</td>
                                            <td><span class="badge bg-success">Pago</span></td>
                                            <td class="text-end">
                                                <a href="admin/pedidos/1057" class="btn btn-light btn-sm" aria-label="Visualizar pedido 1057">
                                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">#1056</td>
                                            <td>Fernanda Lima</td>
                                            <td>04/08/2026</td>
                                            <td>R$ 2.150,00</td>
                                            <td><span class="badge bg-info text-dark">Em separação</span></td>
                                            <td class="text-end">
                                                <a href="admin/pedidos/1056" class="btn btn-light btn-sm" aria-label="Visualizar pedido 1056">
                                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">#1055</td>
                                            <td>Roberto Souza</td>
                                            <td>04/08/2026</td>
                                            <td>R$ 115,50</td>
                                            <td><span class="badge bg-primary">Enviado</span></td>
                                            <td class="text-end">
                                                <a href="admin/pedidos/1055" class="btn btn-light btn-sm" aria-label="Visualizar pedido 1055">
                                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">#1054</td>
                                            <td>Juliana Rocha</td>
                                            <td>03/08/2026</td>
                                            <td>R$ 890,00</td>
                                            <td><span class="badge bg-secondary">Entregue</span></td>
                                            <td class="text-end">
                                                <a href="admin/pedidos/1054" class="btn btn-light btn-sm" aria-label="Visualizar pedido 1054">
                                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produtos com estoque baixo -->
                <div class="col-12 col-xl-5">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                            <h2 class="h5 fw-bold mb-0">Produtos com estoque baixo</h2>
                            <a href="admin/estoque?filtro=baixo" class="btn btn-outline-danger btn-sm">Gerenciar</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <caption class="visually-hidden">Lista de produtos com níveis de estoque baixo ou crítico</caption>
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Produto</th>
                                            <th scope="col">Atual</th>
                                            <th scope="col">Mín.</th>
                                            <th scope="col">Situação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-semibold">Mouse sem fio</td>
                                            <td>2</td>
                                            <td>10</td>
                                            <td><span class="badge bg-danger">Crítico</span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Teclado Mecânico RGB</td>
                                            <td>4</td>
                                            <td>15</td>
                                            <td><span class="badge bg-danger">Crítico</span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Monitor 24 IPS</td>
                                            <td>8</td>
                                            <td>10</td>
                                            <td><span class="badge bg-warning text-dark">Baixo</span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Fone Bluetooth Pro</td>
                                            <td>6</td>
                                            <td>12</td>
                                            <td><span class="badge bg-warning text-dark">Baixo</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notificações e Resumo Operacional -->
            <div class="row g-4">
                <!-- Painel de notificações -->
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                            <h2 class="h5 fw-bold mb-0">Notificações</h2>
                            <a href="admin/notificacoes" class="btn btn-outline-secondary btn-sm">Ver todas</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <a href="admin/produtos/mouse-sem-fio" class="list-group-item list-group-item-action p-3 notification-item unread">
                                    <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                        <h3 class="h6 fw-bold mb-0 text-danger"><i class="bi bi-exclamation-triangle me-2" aria-hidden="true"></i>Estoque Crítico</h3>
                                        <small class="text-muted">Há 10 min</small>
                                    </div>
                                    <p class="mb-1 small text-secondary">O produto "Mouse sem fio" atingiu o estoque crítico com apenas 2 unidades disponíveis.</p>
                                </a>

                                <a href="admin/pedidos/1058" class="list-group-item list-group-item-action p-3 notification-item unread">
                                    <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                        <h3 class="h6 fw-bold mb-0 text-warning text-darken-2"><i class="bi bi-credit-card me-2" aria-hidden="true"></i>Pagamento Pendente</h3>
                                        <small class="text-muted">Há 35 min</small>
                                    </div>
                                    <p class="mb-1 small text-secondary">O pedido #1058 de Mariana Alves aguarda confirmação de pagamento via PIX.</p>
                                </a>

                                <a href="admin/contatos" class="list-group-item list-group-item-action p-3 notification-item">
                                    <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                        <h3 class="h6 fw-bold mb-0 text-info"><i class="bi bi-envelope me-2" aria-hidden="true"></i>Nova Mensagem</h3>
                                        <small class="text-muted">Há 2 horas</small>
                                    </div>
                                    <p class="mb-1 small text-secondary">Você recebeu uma nova mensagem de contato com dúvida sobre frete.</p>
                                </a>

                                <a href="admin/pedidos" class="list-group-item list-group-item-action p-3 notification-item">
                                    <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                        <h3 class="h6 fw-bold mb-0 text-primary"><i class="bi bi-box-seam me-2" aria-hidden="true"></i>Aguardando Separação</h3>
                                        <small class="text-muted">Há 3 horas</small>
                                    </div>
                                    <p class="mb-1 small text-secondary">O pedido #1056 foi confirmado e aguarda envio para separação no depósito.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resumo operacional -->
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                            <h2 class="h5 fw-bold mb-0">Resumo operacional</h2>
                            <a href="admin/relatorios" class="btn btn-outline-primary btn-sm">Acessar relatorios</a>
                        </div>
                        <div class="card-body p-4">
                            <!-- Progresso 1 -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold small">Pedidos processados</span>
                                    <span class="fw-bold small">74%</span>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Pedidos processados" aria-valuenow="74" aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
                                    <div class="progress-bar bg-primary" style="width: 74%"></div>
                                </div>
                            </div>

                            <!-- Progresso 2 -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold small">Pagamentos confirmados</span>
                                    <span class="fw-bold small">86%</span>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Pagamentos confirmados" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
                                    <div class="progress-bar bg-success" style="width: 86%"></div>
                                </div>
                            </div>

                            <!-- Progresso 3 -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold small">Mensagens respondidas</span>
                                    <span class="fw-bold small">63%</span>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Mensagens respondidas" aria-valuenow="63" aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
                                    <div class="progress-bar bg-info" style="width: 63%"></div>
                                </div>
                            </div>

                            <!-- Progresso 4 -->
                            <div class="mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold small">Pedidos enviados</span>
                                    <span class="fw-bold small">70%</span>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Pedidos enviados" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
                                    <div class="progress-bar bg-warning" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Rodapé administrativo -->
        <footer class="bg-white border-top py-3 px-3 px-lg-4 mt-auto">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2 small text-muted">
                <div>
                    &copy; <span id="current-year">2026</span> <strong class="text-dark">Loja Online</strong> - Painel administrativo. Todos os direitos reservados.
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check text-success" aria-hidden="true"></i>
                    <span>Ambiente seguro e protegido</span>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Atualização do ano do rodapé
            const yearSpan = document.getElementById('current-year');
            if (yearSpan) {
                yearSpan.textContent = new Date().getFullYear();
            }

            // Destacar a rota atual no menu lateral
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.sidebar-nav .nav-link');

            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && currentPath.endsWith(href)) {
                    link.classList.add('active');
                    link.setAttribute('aria-current', 'page');
                }
            });
        });
    </script>
</body>
</html>