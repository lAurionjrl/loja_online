<header class="sticky-top bg-white shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-light py-3" aria-label="Navegação Principal">
            <div class="container">
                <a class="navbar-brand text-primary fs-3" href="">Loja Online</a>
                
                <div class="d-flex align-items-center d-lg-none ms-auto me-2">
                    <a href="carrinho" class="btn btn-outline-primary border-0 position-relative me-2" aria-label="Ver Carrinho com 3 itens">
                        <i class="bi bi-cart3 fs-4" aria-hidden="true"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                            3
                            <span class="visually-hidden">itens no carrinho</span>
                        </span>
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Alternar navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produtos">Produtos</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownCategorias" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categorias
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownCategorias">
                                <li><a class="dropdown-item" href="categorias/?v=1">Informática</a></li>
                                <li><a class="dropdown-item" href="categorias/?v=2">Celulares</a></li>
                                <li><a class="dropdown-item" href="categorias/?v=3">Acessórios</a></li>
                                <li><a class="dropdown-item" href="categorias/?v=4">Casa e decoração</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item fw-bold" href="categorias">Ver todas</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ofertas">Ofertas</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownAjuda" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Ajuda
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownAjuda">
                                <li><a class="dropdown-item" href="centraldeajuda/?v=1">Central de ajuda</a></li>
                                <li><a class="dropdown-item" href="perguntasfrequentes/?v=2">Perguntas frequentes</a></li>
                                <li><a class="dropdown-item" href="rastrearpedidos/?v=3">Rastrear pedido</a></li>
                                <li><a class="dropdown-item" href="ajuda/?v=4">Trocas e devoluções</a></li>
                                <li><a class="dropdown-item" href="ajuda/?v=5">Fale conosco</a></li>
                            </ul>
                        </li>
                    </ul>

                    <form class="d-flex me-lg-3 my-2 my-lg-0 flex-grow-1 flex-lg-grow-0" action="buscar" method="get" role="search">
                        <div class="input-group">
                            <label for="search-input" class="visually-hidden">Buscar produtos</label>
                            <input id="search-input" class="form-control" type="search" name="q" placeholder="Buscar produtos..." aria-label="Buscar produtos">
                            <button class="btn btn-primary" type="submit" aria-label="Executar busca">
                                <i class="bi bi-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>

                    <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1" type="button" id="dropdownAccount" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person fs-5" aria-hidden="true"></i>
                                <span>Conta</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                                <li><a class="dropdown-item" href="cliente/login">Entrar</a></li>
                                <li><a class="dropdown-item" href="cliente/cadastro">Criar conta</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="cliente/pedidos">Meus pedidos</a></li>
                            </ul>
                        </div>

                        <a href="carrinho" class="btn btn-primary position-relative d-none d-lg-inline-flex align-items-center gap-2" aria-label="Carrinho de compras com 3 itens">
                            <i class="bi bi-cart3 fs-5" aria-hidden="true"></i>
                            <span>Carrinho</span>
                            <span class="badge bg-danger rounded-pill">3</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
